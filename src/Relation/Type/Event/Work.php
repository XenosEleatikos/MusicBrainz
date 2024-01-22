<?php

namespace MusicBrainz\Relation\Type\Event;

use MusicBrainz\Value\EntityType;

/**
 * A relation of an event to a work
 *
 * @link https://musicbrainz.org/relationships/event-work
 */
abstract class Work extends \MusicBrainz\Relation\Type\Event
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::WORK);
    }
}
