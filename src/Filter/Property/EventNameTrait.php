<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait EventNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the event's name.
     *
     * @return string
     *
     * @internal
     */
    public static function eventName(): string
    {
        return 'event';
    }

    /**
     * Searches for the event's name (diacritics are ignored).
     *
     * @param Name $eventName
     *
     * @return static
     */
    public function addEventName(Name $eventName): static
    {
        $this->addPhrase((string) $eventName, self::eventName());

        return $this;
    }
}
