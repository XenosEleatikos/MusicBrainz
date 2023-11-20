<?php

namespace MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

use MusicBrainz\Value\Name;
use MusicBrainz\Relation\Type\Artist\Place;

/**
 * This relationship links a group with the institution (esp. educational institution) they're associated with.
 *
 * @link https://musicbrainz.org/relationship/24fce292-8a25-4039-b313-611a3678a42a
 */
class AssociatedWith extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('associated with');
    }
}
