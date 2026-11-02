<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording;

use MusicBrainz\Relation\Type\Recording\Recording;

/**
 * This links a recording to another containing official commentary for it (usually the artist talking about it).
 *
 * @link https://musicbrainz.org/relationship/420fa5d6-8dbb-458f-8b5c-4e786c9e4de0
 */
class Commentary extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'commentary';
    }
}
