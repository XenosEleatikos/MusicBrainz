<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

use MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

/**
 * This relationship links a musician to the music school(s) they taught at.
 *
 * @link https://musicbrainz.org/relationship/3e23fc35-10c3-4dc9-a4f5-e3803643d5c1
 */
class TaughtAt extends EducationalInstitutionConnection
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'taught at';
    }
}
