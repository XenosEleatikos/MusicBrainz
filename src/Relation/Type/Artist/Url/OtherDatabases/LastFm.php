<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * This relationship type links an artist to its corresponding page at Last.fm.
 *
 * @link https://musicbrainz.org/relationship/08db8098-c0df-4b78-82c3-c8697b4bba7f
 */
class LastFm extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'last.fm';
    }
}
