<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * The API client configuration
 */
class Config
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
    private string $userAgent = 'XenosMusicBrainz/2 ( https://github.com/XenosEleatikos/MusicBrainz )';

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
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getMinRequestInterval(): float
    {
        return $this->minRequestInterval;
    }

    public function setMinRequestInterval(float $seconds): self
    {
        $this->minRequestInterval = $seconds;

        return $this;
    }

    public function getMaxRetries(): int
    {
        return $this->maxRetries;
    }

    public function setMaxRetries(int $maxRetries): self
    {
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
     */
    public function setApiUrl(string $apiUrl): Config
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }
}
