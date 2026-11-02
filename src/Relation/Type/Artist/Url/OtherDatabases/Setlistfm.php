<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * This relationship type links an artist to its corresponding page at setlist.fm.
 *
 * @link https://musicbrainz.org/relationship/bf5d0d5e-27a1-4e94-9df7-3cdc67b3b207
 */
class Setlistfm extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'setlistfm';
    }
}
