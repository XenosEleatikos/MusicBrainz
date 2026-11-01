<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event;

/**
 * Links an event to an artist that was a conductor in it.
 *
 * @link https://musicbrainz.org/relationship/92873f0d-12a7-4fb3-9eac-ff06c38c6a60
 */
class Conductor extends Event
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'conductor';
    }
}
