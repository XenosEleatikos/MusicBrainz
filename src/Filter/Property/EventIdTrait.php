<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait EventIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the MBID of the event.
     *
     * @return string
     */
    public static function eventId(): string
    {
        return 'eid';
    }

    /**
     * Searches for the MBID of the event.
     *
     * @param MBID $eventId
     *
     * @return static
     */
    public function addEventId(MBID $eventId): static
    {
        $this->addTerm((string) $eventId, self::eventId());

        return $this;
    }
}
