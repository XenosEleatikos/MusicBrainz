<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Genre\Genre;

use MusicBrainz\Relation\Type\Genre\Genre;

/**
 * This links a genre to its subgenres.
 *
 * @link https://musicbrainz.org/relationship/9d61bc67-fa39-4719-8025-ea056a5bd7e6
 */
class Subgenre extends Genre
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'subgenre';
    }
}
