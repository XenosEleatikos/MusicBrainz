<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait EventNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the event's name.
     *
     * @return string
     *
     * @internal
     */
    public static function eventNameWithAccents(): string
    {
        return 'eventaccent';
    }

    /**
     * Searches for the event's name (with the specified diacritics).
     *
     * @param Name $eventName
     *
     * @return static
     */
    public function addEventNameWithAccents(Name $eventName): static
    {
        $this->addPhrase((string) $eventName, self::eventNameWithAccents());

        return $this;
    }
}
