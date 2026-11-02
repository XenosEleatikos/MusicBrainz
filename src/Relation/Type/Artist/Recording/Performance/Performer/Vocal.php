<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Performance\Performer;

use MusicBrainz\Relation\Type\Artist\Recording\Performance\Performer;

/**
 * Indicates an artist that performed vocals on this recording.
 *
 * @link https://musicbrainz.org/relationship/0fdbe3c6-7700-4a31-ae54-b53f06ae1cfa
 */
class Vocal extends Performer
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'vocal';
    }
}
