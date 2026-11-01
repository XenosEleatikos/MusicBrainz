<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place;

use MusicBrainz\Relation\Type\Artist\Place;
use MusicBrainz\Value\Name;

/**
 * This links a place (often a concert hall or educational institution) to an artist who has an artist-in-residence
 * position with it.
 *
 * @link https://musicbrainz.org/relationship/9e338897-2b63-40a8-b7c1-fca0dbbaa3cd
 */
class ResidencePosition extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('artist-in-residence');
    }
}
