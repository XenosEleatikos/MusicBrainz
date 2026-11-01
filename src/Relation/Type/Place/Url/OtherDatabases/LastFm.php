<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

/**
 * This relationship type links a place to its corresponding page at Last.fm.
 *
 * @link https://musicbrainz.org/relationship/c3ddb53d-a7df-4486-8cc7-c1b7baec994e
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
