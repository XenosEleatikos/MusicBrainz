<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

/**
 * Points to the Geonames page for this place.
 *
 * @link https://musicbrainz.org/relationship/c4c6356f-9cbc-4e26-ae76-63eef96d059d
 */
class Geonames extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'geonames';
    }
}
