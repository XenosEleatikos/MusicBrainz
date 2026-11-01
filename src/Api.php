<?php

declare(strict_types=1);

namespace MusicBrainz;

use MusicBrainz\Api\Browse;
use MusicBrainz\Api\Lookup;
use MusicBrainz\Api\Search;
use MusicBrainz\Http\ApiClient;

/**
 * Provides methods to get classes for each type of API call: browse, lookup and search.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API
 */
class Api
{
    /**
     * The API client
     *
     * @var ApiClient
     */
    private ApiClient $apiClient;

    /**
     * The API client configuration
     *
     * @var Config
     */
    private Config $config;

    /**
     * Constructs the API.
     *
     * @param ApiClient $apiClient The API client
     * @param Config    $config    The API client configuration
     */
    public function __construct(ApiClient $apiClient, Config $config)
    {
        $this->apiClient = $apiClient;
        $this->config =  $config;
    }

    /**
     * Returns the browse API.
     *
     * @return Browse
     */
    public function browse(): Browse
    {
        return new Browse($this->apiClient, $this->config);
    }

    /**
     * Returns the lookup API.
     *
     * @return Lookup
     */
    public function lookup(): Lookup
    {
        return new Lookup($this->apiClient, $this->config);
    }

    /**
     * Returns the search API.
     *
     * @return Search
     */
    public function search(): Search
    {
        return new Search($this->apiClient, $this->config);
    }
}
