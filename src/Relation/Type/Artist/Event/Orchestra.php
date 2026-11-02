<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event;

/**
 * Links an event to an orchestra that performed in it.
 *
 * @link https://musicbrainz.org/relationship/9b2d5b96-b4d9-4bce-b056-c369ced25e81
 */
class Orchestra extends Event
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'orchestra';
    }
}
