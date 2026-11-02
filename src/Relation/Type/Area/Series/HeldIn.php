<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Series;

use MusicBrainz\Relation\Type\Area\Series;

/**
 * Indicates the area an event series was held in.
 *
 * @link https://musicbrainz.org/relationship/281bf307-f1e8-4a56-a7b8-fe8304bb2bf3
 */
class HeldIn extends Series
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'held in';
    }
}
