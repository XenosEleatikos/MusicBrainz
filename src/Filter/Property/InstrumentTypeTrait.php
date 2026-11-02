<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\InstrumentTypeKind;

trait InstrumentTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the instrument's type.
     *
     * @return string
     *
     * @internal
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
     * @return static
     */
    public function addInstrumentType(InstrumentTypeKind $instrumentType): static
    {
        $this->addPhrase($instrumentType->value, self::instrumentType());

        return $this;
    }
}
