<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Genre;

use MusicBrainz\Relation\Type\Artist\Genre as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the artist that inspired this genre’s name.
 *
 * @link https://musicbrainz.org/relationship/cac1064d-1605-4d41-ac6d-040915480eb5
 */
class NamedAfterArtist extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('named after artist');
    }
}
