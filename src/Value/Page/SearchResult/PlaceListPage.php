<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Page\SearchResult;

use MusicBrainz\Value\SearchResult\Place;
use MusicBrainz\Value\Page;

/**
 * A list of values
 */
class PlaceListPage extends Page
{
    /**
     * Returns the class name of the list elements.
     *
     * @return string
     */
    public static function getType(): string
    {
        return Place::class;
    }
}
