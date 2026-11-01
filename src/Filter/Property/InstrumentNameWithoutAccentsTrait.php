<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait InstrumentNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the instrument's name.
     *
     * @return string
     */
    public static function instrumentNameWithoutAccents(): string
    {
        return 'instrument';
    }

    /**
     * Searches for the instrument's name (diacritics are ignored).
     *
     * @param Name $instrumentName
     *
     * @return static
     */
    public function addInstrumentNameWithoutAccents(Name $instrumentName): static
    {
        $this->addPhrase((string) $instrumentName, self::instrumentNameWithoutAccents());

        return $this;
    }
}
