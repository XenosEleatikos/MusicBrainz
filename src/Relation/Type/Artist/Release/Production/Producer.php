<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production;

use MusicBrainz\Relation\Type\Artist\Release\Production;

/**
 * This indicates an artist who is responsible for the creative and practical day-to-day aspects involved with making a
 * musical recording.
 *
 * @link https://musicbrainz.org/relationship/8bf377ba-8d71-4ecc-97f2-7bb2d8a2a75f
 */
class Producer extends Production
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'producer';
    }
}
