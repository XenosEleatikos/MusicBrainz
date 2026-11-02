<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

/**
 * Points to the Wikipedia page for this place.
 *
 * @link https://musicbrainz.org/relationship/82680bbb-0391-4344-9687-4f419df4b97a
 */
class Wikipedia extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'wikipedia';
    }
}
