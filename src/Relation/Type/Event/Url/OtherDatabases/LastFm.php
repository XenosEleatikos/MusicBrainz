<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

/**
 * This relationship type links an event to its corresponding page at Last.fm.
 *
 * @link https://musicbrainz.org/relationship/fd86b01d-c8f7-4f0a-a077-81855a9cfeef
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
