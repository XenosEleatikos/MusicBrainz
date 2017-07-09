<?php

namespace MusicBrainz\Value\SearchResult;

use MusicBrainz\Value\Annotation;
use MusicBrainz\Value\SearchResult;
use MusicBrainz\Value\SearchResultList;

/**
 * A list of results from the search API
 */
class AnnotationList extends SearchResultList
{
    /**
     * Constructs a list of results from the search API.
     *
     * @param array $searchResults A list of results from the search API
     */
    public function __construct(array $searchResults = [])
    {
        parent::__construct($searchResults, 'annotations', Annotation::class);
    }

    /**
     * Returns the class name of the list elements.
     *
     * @return string
     */
    public static function getType(): string
    {
        return SearchResult::class;
    }
}