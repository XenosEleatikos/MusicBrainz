<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place;

use MusicBrainz\Relation\Type\Artist\Place;

/**
 * This indicates the artist that inspired this place’s name.
 *
 * @link https://musicbrainz.org/relationship/8a3994fd-71ec-4443-9882-2192801241f2
 */
class NamedAfter extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after artist';
    }
}
