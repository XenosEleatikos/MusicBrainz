<?php

namespace MusicBrainz\Value\SearchResult;

use MusicBrainz\Value\Property\ReleasesTrait;
use MusicBrainz\Value\SearchResult;

/**
 * A list of results from the search API
 */
class Release extends SearchResult
{
    use ReleasesTrait;

    /**
     * Constructs a list of results from the search API.
     *
     * @param array $searchResult A search result from the search API
     */
    public function __construct(array $searchResult = [])
    {
        $this->setReleasesFromArray($searchResult, null);
        parent::__construct($searchResult);
    }

    /**
     * Returns the search result as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getReleases();
    }
}
