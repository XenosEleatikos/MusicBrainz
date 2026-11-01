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
 */
final class ApiClient
{
    /** Timestamp of the last request in seconds, shared by all instances (the limit applies per IP address). */
    private static float $lastRequest = 0.0;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly RequestFactoryInterface $requestFactory,
    ) {}

    /**
     * Performs a GET request and returns the decoded JSON response.
     *
     * @param string               $path           Path relative to the API URL, e.g. "artist/<mbid>"
     * @param array<string, mixed> $params         Query parameters
     * @param bool                 $isAuthRequired Whether an access token is required
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

        if ($isAuthRequired) {
            $token = $config->getAccessToken();
            if (null === $token || '' === $token) {
                throw new Exception('Authentication is required: set an OAuth2 access token in the configuration');
            }
            $request = $request->withHeader('Authorization', 'Bearer ' . $token);
        }

        $attempt = 0;
        do {
            $this->throttle($config->getMinRequestInterval());
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $exception) {
                throw new Exception($exception->getMessage(), 0, $exception);
            }
            self::$lastRequest = microtime(true);
        } while (503 === $response->getStatusCode() && $attempt++ < $config->getMaxRetries() && $this->wait($response));

        return $this->decode($response);
    }

    private function throttle(float $interval): void
    {
        $remaining = self::$lastRequest + $interval - microtime(true);
        if ($remaining > 0) {
            usleep((int) ($remaining * 1_000_000));
        }
    }

    private function wait(ResponseInterface $response): bool
    {
        $retryAfter = $response->getHeaderLine('Retry-After');
        usleep((int) (max(1.0, (float) $retryAfter) * 1_000_000));

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
