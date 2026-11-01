<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event\NonPerformingRelationships;

use MusicBrainz\Relation\Type\Artist\Event\NonPerformingRelationships;

/**
 * This relationship specifies that an event was held as a tribute/homage to a specific artist.
 *
 * @link https://musicbrainz.org/relationship/4ef86173-7f40-486d-bf8d-c38b1097e77f
 */
class TributeTo extends NonPerformingRelationships
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'tribute to';
    }
}
