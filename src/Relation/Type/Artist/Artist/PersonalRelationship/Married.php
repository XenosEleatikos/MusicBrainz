<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\PersonalRelationship;

use MusicBrainz\Relation\Type\Artist\Artist\PersonalRelationship;

/**
 * This links artists who were married.
 *
 * @link https://musicbrainz.org/relationship/b2bf7a5d-2da6-4742-baf4-e38d8a7ad029
 */
class Married extends PersonalRelationship
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'married';
    }
}
