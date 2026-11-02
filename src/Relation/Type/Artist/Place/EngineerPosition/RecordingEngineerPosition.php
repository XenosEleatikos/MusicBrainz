<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place\EngineerPosition;

use MusicBrainz\Relation\Type\Artist\Place\EngineerPosition;

/**
 * Describes the fact a person was contracted by a place as a recording engineer.
 *
 * @link https://musicbrainz.org/relationship/350f7ab7-c2d9-4f00-98e0-e1973bf4a2bf
 */
class RecordingEngineerPosition extends EngineerPosition
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'recording engineer position';
    }
}
