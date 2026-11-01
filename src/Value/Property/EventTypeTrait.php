<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\EventType;

/**
 * Provides a getter for an event type.
 */
trait EventTypeTrait
{
    private ?EventType $eventType;

    /**
     * Returns an event type, or null if the web service did not deliver one.
     */
    public function getEventType(): ?EventType
    {
        return $this->eventType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setEventTypeFromArray(array $input): void
    {
        $this->eventType = EventType::fromArray($input, 'type', 'type-id');
    }
}
