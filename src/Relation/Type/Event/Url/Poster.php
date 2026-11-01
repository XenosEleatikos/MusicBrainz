<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url;

/**
 * This relationship type links an event to a promotional poster for the event. Deprecated, use the Event Art Archive
 * instead.
 *
 * @link https://musicbrainz.org/relationship/ca7ada80-bf87-4422-9671-ec0a22733acc
 */
class Poster extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'poster';
    }
}
