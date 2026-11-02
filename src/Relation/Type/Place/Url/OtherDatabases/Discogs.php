<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

/**
 * This is used to link a place to the equivalent entry in Discogs.
 *
 * @link https://musicbrainz.org/relationship/1c140ac8-8dc2-449e-92cb-52c90d525640
 */
class Discogs extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'discogs';
    }
}
