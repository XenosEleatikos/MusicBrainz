<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

/**
 * Points to the Internet Movie Database page for this place.
 *
 * @link https://musicbrainz.org/relationship/815bc5ca-c2fb-4dc6-a89b-9150888b0d4d
 */
class IMDb extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'IMDb';
    }
}
