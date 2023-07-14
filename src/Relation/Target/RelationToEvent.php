<?php

namespace MusicBrainz\Relation\Target;

use MusicBrainz\Relation;
use MusicBrainz\Value\Event;
use MusicBrainz\Value\EntityType;

/**
 * An event relation
 */
class RelationToEvent extends Relation
{
    /**
     * The related event
     *
     * @var Event
     */
    private $event;

    /**
     * Sets the related event.
     *
     * @param array $event Information about the related event
     *
     * @return void
     */
    protected function setRelatedEntity(array $event): void
    {
        $this->event = new Event($event);
    }

    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::EVENT);
    }

    /**
     * Returns the related event.
     *
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }
}
