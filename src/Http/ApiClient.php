<?php

declare(strict_types=1);

namespace MusicBrainz\Http;

use JsonException;
use MusicBrainz\Config;
use MusicBrainz\Exception;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;

use function http_build_query;
use function is_array;
use function json_decode;
use function max;
use function microtime;
use function parse_url;
use function strtotime;
use function time;
use function is_numeric;
use function trim;
use function usleep;
use function is_string;

use const JSON_THROW_ON_ERROR;
use const PHP_QUERY_RFC3986;

/**
 * Executes requests against the MusicBrainz web service using any PSR-18 HTTP client.
 *
 * Takes care of the User-Agent header, authentication, the rate limit of one request per second and retries on
 * HTTP 503 responses.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API/Rate_Limiting
 *
 * @internal
 */
final class ApiClient
{
    /** The longest pause between two attempts that is accepted (seconds). A server asking for more is not waited for. */
    private const MAX_RETRY_DELAY = 60.0;

    /**
     * Timestamps of the last request in seconds by host, shared by all instances (the limit applies per IP address and
     * server).
     *
     * @var array<string, float>
     */
    private static array $lastRequest = [];

    public function __construct(
        private readonly ClientInterface $client,
        private readonly RequestFactoryInterface $requestFactory,
    ) {}

    /**
     * Performs a GET request and returns the decoded JSON response.
     *
     * @param string               $path           Path relative to the API URL, e.g. "artist/<mbid>"
     * @param Config               $config         The configuration (API URL, user agent, access token)
     * @param array<string, mixed> $params         Query parameters
     * @param bool                 $isAuthRequired Whether the request cannot be answered without an access token
     *
     * @return array<mixed, mixed>
     *
     * @throws Exception
     */
    public function call(string $path, Config $config, array $params = [], bool $isAuthRequired = false): array
    {
        if ('' === trim($config->getUserAgent())) {
            throw new Exception('You must set a valid User Agent before accessing the MusicBrainz API');
        }

        $params['fmt'] = 'json';
        $url = $config->getApiUrl() . '/' . $path . '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);

        $request = $this->requestFactory->createRequest('GET', $url)
            ->withHeader('Accept', 'application/json')
            ->withHeader('User-Agent', $config->getUserAgent());

        // A configured token is always sent (it lets the web service show private collections, for example); it is
        // required for requests that deliver user data.
        $token = $config->getAccessToken();
        if (null !== $token && '' !== $token) {
            $request = $request->withHeader('Authorization', 'Bearer ' . $token);
        } elseif ($isAuthRequired) {
            throw new Exception('Authentication is required: set an OAuth2 access token in the configuration');
        }

        $host = (string) parse_url($url, PHP_URL_HOST);
        $attempt = 0;
        do {
            $this->throttle($host, $config->getMinRequestInterval());
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $exception) {
                throw new Exception($exception->getMessage(), 0, $exception);
            }
            self::$lastRequest[$host] = microtime(true);
        } while (503 === $response->getStatusCode() && $attempt++ < $config->getMaxRetries() && $this->wait($response));

        return $this->decode($response);
    }

    private function throttle(string $host, float $interval): void
    {
        $remaining = (self::$lastRequest[$host] ?? 0.0) + $interval - microtime(true);
        if ($remaining > 0) {
            usleep((int) ($remaining * 1_000_000));
        }
    }

    /**
     * Waits as long as the server asked for (at least one second) and returns true; returns false without waiting if the
     * server asks for more than {@see MAX_RETRY_DELAY} seconds.
     */
    private function wait(ResponseInterface $response): bool
    {
        $retryAfter = trim($response->getHeaderLine('Retry-After'));

        if (is_numeric($retryAfter)) {
            $seconds = (float) $retryAfter;
        } elseif ('' !== $retryAfter && false !== ($time = strtotime($retryAfter))) {
            // The HTTP-date form
            $seconds = (float) ($time - time());
        } else {
            $seconds = 0.0;
        }

        $seconds = max(1.0, $seconds);
        if ($seconds > self::MAX_RETRY_DELAY) {
            return false;
        }

        usleep((int) ($seconds * 1_000_000));

        return true;
    }

    /**
     * @return array<mixed, mixed>
     */
    private function decode(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        $status = $response->getStatusCode();

        try {
            $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            $data = null;
        }

        if ($status >= 400) {
            $message = is_array($data) && isset($data['error']) && is_string($data['error'])
                ? $data['error']
                : 'HTTP ' . $status;
            throw new Exception('MusicBrainz API error: ' . $message, $status);
        }

        if (!is_array($data)) {
            throw new Exception('Unexpected response from the web service: ' . $body);
        }

        return $data;
    }
}
