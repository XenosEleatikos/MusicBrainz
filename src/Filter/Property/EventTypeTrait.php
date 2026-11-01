<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\EventTypeKind;

trait EventTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the event's type.
     *
     * @return string
     */
    public static function eventType(): string
    {
        return 'type';
    }

    /**
     * Searches for the event's type.
     *
     * @param EventTypeKind $eventType
     *
     * @return Phrase
     */
    public function addEventType(EventTypeKind $eventType): Phrase
    {
        return $this->addPhrase($eventType->value, self::eventType());
    }
}
