<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait InstrumentDescriptionTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the description of the instrument.
     *
     * @return string
     */
    public static function instrumentDescription(): string
    {
        return 'description';
    }

    /**
     * Searches for the description of the instrument (in English).
     *
     * @param Name $description
     *
     * @return Phrase
     */
    public function addInstrumentDescription(Name $description): Phrase
    {
        return $this->addPhrase((string) $description, self::instrumentDescription());
    }
}
