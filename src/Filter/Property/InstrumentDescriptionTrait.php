<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait InstrumentDescriptionTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the description of the instrument.
     *
     * @return string
     *
     * @internal
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
     * @return static
     */
    public function addInstrumentDescription(Name $description): static
    {
        $this->addPhrase((string) $description, self::instrumentDescription());

        return $this;
    }
}
