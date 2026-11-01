<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording;

/**
 * This indicates an organization (often a radio station) broadcast the given recording.
 *
 * @link https://musicbrainz.org/relationship/b908f91f-cf13-4ef7-9c84-b7f1122162c6
 */
class Broadcast extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'broadcast';
    }
}
