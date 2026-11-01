<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist;

use MusicBrainz\Relation\Type\Artist\Artist;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/92859e2a-f2e5-45fa-a680-3f62ba0beccc
 */
class MusicalRelationships extends Artist
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'musical relationships';
    }
}
