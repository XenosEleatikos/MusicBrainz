<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Page\SearchResult;

use MusicBrainz\Value\SearchResult\Work;
use MusicBrainz\Value\Page;

/**
 * A list of values
 */
class WorkListPage extends Page
{
    /**
     * Returns the class name of the list elements.
     *
     * @return string
     */
    public static function getType(): string
    {
        return Work::class;
    }
}
