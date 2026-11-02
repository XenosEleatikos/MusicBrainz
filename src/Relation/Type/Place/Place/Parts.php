<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Place;

use MusicBrainz\Relation\Type\Place\Place;

/**
 * This indicates that a place is part of another place.
 *
 * @link https://musicbrainz.org/relationship/ff683f48-eff1-40ab-a58f-b128098ffe92
 */
class Parts extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'parts';
    }
}
