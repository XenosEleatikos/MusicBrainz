<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait InstrumentNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the instrument's name (with the specified diacritics).
     *
     * @return string
     *
     * @internal
     */
    public static function instrumentNameWithAccents(): string
    {
        return 'instrumentaccent';
    }

    /**
     * Searches for the instrument's name (with the specified diacritics).
     *
     * @param Name $instrumentName
     *
     * @return static
     */
    public function addInstrumentNameWithAccents(Name $instrumentName): static
    {
        $this->addPhrase((string) $instrumentName, self::instrumentNameWithAccents());

        return $this;
    }
}
