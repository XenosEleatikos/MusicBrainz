<?php

namespace MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

use MusicBrainz\Value\Name;
use MusicBrainz\Relation\Type\Artist\Place;

/**
 * This relationship links a musician to the music school(s) they taught at.
 *
 * @link https://musicbrainz.org/relationship/3e23fc35-10c3-4dc9-a4f5-e3803643d5c1
 */
class TaughtAt extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('taught at');
    }
}
