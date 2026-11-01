<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\InstrumentTypeKind;

trait InstrumentTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the instrument's type.
     *
     * @return string
     */
    public static function instrumentType(): string
    {
        return 'type';
    }

    /**
     * Searches for the instrument's type.
     *
     * @param InstrumentTypeKind $instrumentType
     *
     * @return Phrase
     */
    public function addInstrumentType(InstrumentTypeKind $instrumentType): Phrase
    {
        return $this->addPhrase($instrumentType->value, self::instrumentType());
    }
}
