<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Recording;

use MusicBrainz\Relation\Type\Place\Recording;

/**
 * Links a recording to the place it was produced at.
 *
 * @link https://musicbrainz.org/relationship/6bc3827d-bc20-4621-ae14-9c3707ad140a
 */
class ProducedAt extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'produced at';
    }
}
