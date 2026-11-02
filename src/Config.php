<?php

declare(strict_types=1);

namespace MusicBrainz;

use function is_finite;
use function preg_match;
use function rtrim;
use function trim;

/**
 * The API client configuration
 */
final class Config
{
    /**
     * An OAuth2 access token, required for user specific data (user-tags, user-ratings, user-genres, private
     * collections).
     *
     * @see https://musicbrainz.org/doc/Development/OAuth2
     */
    private ?string $accessToken = null;

    /**
     * Minimum interval between two requests in seconds. MusicBrainz allows one request per second per IP address.
     */
    private float $minRequestInterval = 1.0;

    /**
     * Maximum number of retries if the web service answers with HTTP 503.
     */
    private int $maxRetries = 2;

    /**
     * The user agent
     * The user agent is delivered with every request. You may overwrite the default value with the name of your own
     * application.
     *
     * @var string
     */
    /** The user agent used if the application sets none. All applications share it, so please set your own. */
    public const DEFAULT_USER_AGENT = 'XenosMusicBrainz/2 ( https://github.com/XenosEleatikos/MusicBrainz )';

    private string $userAgent = self::DEFAULT_USER_AGENT;

    /**
     * URL of the MusicBrainz API
     *
     * @var string
     */
    private string $apiUrl = 'https://musicbrainz.org/ws/2';

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(?string $accessToken): self
    {
        if (null !== $accessToken) {
            self::assertHeaderValue($accessToken, 'access token');
        }
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getMinRequestInterval(): float
    {
        return $this->minRequestInterval;
    }

    public function setMinRequestInterval(float $seconds): self
    {
        if (!is_finite($seconds) || $seconds < 0) {
            throw new InvalidArgumentException('The interval between requests must be a number of seconds that is not negative, got ' . $seconds);
        }
        $this->minRequestInterval = $seconds;

        return $this;
    }

    public function getMaxRetries(): int
    {
        return $this->maxRetries;
    }

    public function setMaxRetries(int $maxRetries): self
    {
        if ($maxRetries < 0) {
            throw new InvalidArgumentException('The number of retries must not be negative, got ' . $maxRetries);
        }
        $this->maxRetries = $maxRetries;

        return $this;
    }

    /**
     * Returns the user agent.
     *
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Sets the user agent.
     *
     * @param string $userAgent The user agent
     *
     * @return self
     */
    public function setUserAgent(string $userAgent): self
    {
        self::assertHeaderValue($userAgent, 'user agent');
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Returns the URL of the MusicBrainz API.
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * Sets the URL of the MusicBrainz API.
     *
     * @param string $apiUrl The URL of the MusicBrainz API
     *
     * @return self
     *
     * @throws InvalidArgumentException If the URL does not start with http:// or https://
     */
    public function setApiUrl(string $apiUrl): Config
    {
        if (1 !== preg_match('~^https?://[^/\s]+~i', $apiUrl)) {
            throw new InvalidArgumentException('The API URL must start with http:// or https://, got "' . $apiUrl . '"');
        }
        $this->apiUrl = rtrim($apiUrl, '/');

        return $this;
    }

    /**
     * @throws InvalidArgumentException if the value is empty or cannot be an HTTP header value
     */
    private static function assertHeaderValue(string $value, string $name): void
    {
        if ('' === trim($value) || 1 === preg_match('/[\x00-\x1F\x7F]/', $value)) {
            throw new InvalidArgumentException('The ' . $name . ' must not be empty and must not contain control characters');
        }
    }
}
