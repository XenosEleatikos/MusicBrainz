<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait EventNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the event's name.
     *
     * @return string
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
     * @return Phrase
     */
    public function addEventNameWithAccents(Name $eventName): Phrase
    {
        return $this->addPhrase((string) $eventName, self::eventNameWithAccents());
    }
}
