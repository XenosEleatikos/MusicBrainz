<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Place;

use MusicBrainz\Relation\Type\Place\Place;

/**
 * Indicates a place that moved from one location to another, while still being generally considered the same.
 *
 * @link https://musicbrainz.org/relationship/69c3ef7a-7fec-4e0a-ae6c-0b0535509528
 */
class RelocatedTo extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'relocated to';
    }
}
