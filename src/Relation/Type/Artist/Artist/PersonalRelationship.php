<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist;

use MusicBrainz\Relation\Type\Artist\Artist;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/e794f8ff-b77b-4dfe-86ca-83197146ef10
 */
class PersonalRelationship extends Artist
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'personal relationship';
    }
}
