<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait InstrumentNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the instrument's name.
     *
     * @return string
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
     * @return Phrase
     */
    public function addInstrumentNameWithAccents(Name $instrumentName): Phrase
    {
        return $this->addPhrase((string) $instrumentName, self::instrumentNameWithAccents());
    }
}
