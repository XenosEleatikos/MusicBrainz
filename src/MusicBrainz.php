<?php

declare(strict_types=1);

namespace MusicBrainz;

use MusicBrainz\Http\ApiClient;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * The library's main class
 */
class MusicBrainz
{
    private readonly ApiClient $apiClient;

    private readonly Config $config;

    /**
     * A logger. Static, because value objects log unexpected API data while parsing.
     */
    private static LoggerInterface $logger;

    /**
     * Constructs the MusicBrainz API client.
     *
     * @param ClientInterface         $client         Any PSR-18 HTTP client
     * @param RequestFactoryInterface $requestFactory Any PSR-17 request factory
     * @param null|LoggerInterface    $logger         A PSR-3 logger
     * @param null|Config             $config         A set of configuration
     */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        ?LoggerInterface $logger = null,
        ?Config $config = null,
    ) {
        $this->apiClient = new ApiClient($client, $requestFactory);
        $this->config    = $config ?? new Config();
        self::$logger    = $logger ?? new NullLogger();
    }

    /**
     * Returns the API.
     *
     * @return Api
     */
    public function api(): Api
    {
        return new Api($this->apiClient, $this->config());
    }

    /**
     * Returns the configuration.
     *
     * @return Config
     */
    public function config(): Config
    {
        return $this->config;
    }

    /**
     * Returns the logger.
     *
     * @return LoggerInterface
     */
    public static function log(): LoggerInterface
    {
        return self::$logger ??= new NullLogger();
    }
}
