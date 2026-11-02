<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships;

use MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships;

/**
 * This relationship indicates that a person was another's teacher/student.
 *
 * @link https://musicbrainz.org/relationship/249fc24f-d573-4290-9d74-0547712d1f1e
 */
class Teacher extends MusicalRelationships
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'teacher';
    }
}
