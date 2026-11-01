<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

use MusicBrainz\Relation\Type\Artist\Place\EducationalInstitutionConnection;

/**
 * This relationship links a group with the institution (esp. educational institution) they're associated with.
 *
 * @link https://musicbrainz.org/relationship/24fce292-8a25-4039-b313-611a3678a42a
 */
class AssociatedWith extends EducationalInstitutionConnection
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'associated with';
    }
}
