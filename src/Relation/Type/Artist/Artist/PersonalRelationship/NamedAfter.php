<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\PersonalRelationship;

use MusicBrainz\Relation\Type\Artist\Artist\PersonalRelationship;

/**
 * This indicates the artist that inspired this artist’s name.
 *
 * @link https://musicbrainz.org/relationship/1af24726-5b1f-4b07-826e-5351723f504b
 */
class NamedAfter extends PersonalRelationship
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
