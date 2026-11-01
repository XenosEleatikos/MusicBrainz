<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event;

/**
 * Links an event to (one of) its main performer(s).
 *
 * @link https://musicbrainz.org/relationship/936c7c95-3156-3889-a062-8a0cd57f8946
 */
class MainPerformer extends Event
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'main performer';
    }
}
