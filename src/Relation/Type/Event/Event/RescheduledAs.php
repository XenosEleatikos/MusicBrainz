<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Event;

use MusicBrainz\Relation\Type\Event\Event;

/**
 * This links a postponed event to the later rescheduled event.
 *
 * @link https://musicbrainz.org/relationship/eb39ba59-5c98-4af7-8475-02a28e235ba4
 */
class RescheduledAs extends Event
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'rescheduled as';
    }
}
