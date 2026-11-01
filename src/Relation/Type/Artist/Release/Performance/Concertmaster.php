<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Performance;

use MusicBrainz\Relation\Type\Artist\Release\Performance;

/**
 * This indicates an artist who was the concertmaster/leader for an orchestra or band on this release.
 *
 * @link https://musicbrainz.org/relationship/8a2b1c46-0fe5-42f7-9d72-f68604244c1d
 */
class Concertmaster extends Performance
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'concertmaster';
    }
}
