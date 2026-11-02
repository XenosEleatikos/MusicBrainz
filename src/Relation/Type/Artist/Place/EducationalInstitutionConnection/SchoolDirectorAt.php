<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

use MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

/**
 * This relationship links a person to the music school(s) they directed.
 *
 * @link https://musicbrainz.org/relationship/0dafbb5d-26eb-4a52-bb0c-af13ffe36544
 */
class SchoolDirectorAt extends EducationalInstitutionConnection
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'school director at';
    }
}
