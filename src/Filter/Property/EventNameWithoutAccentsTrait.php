<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait EventNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the event's name.
     *
     * @return string
     */
    public static function eventNameWithoutAccents(): string
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
    public function addEventNameWithoutAccents(Name $eventName): static
    {
        $this->addPhrase((string) $eventName, self::eventNameWithoutAccents());

        return $this;
    }
}
