<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Page\SearchResult;

use MusicBrainz\Value\SearchResult\CdStub;
use MusicBrainz\Value\Page;

/**
 * A list of values
 */
class CdStubListPage extends Page
{
    /**
     * Returns the class name of the list elements.
     *
     * @return string
     */
    public static function getType(): string
    {
        return CdStub::class;
    }
}
