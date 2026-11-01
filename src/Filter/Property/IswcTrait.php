<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\ISWC;

trait IswcTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the International Standard Musical Work Code (ISWC).
     *
     * @return string
     */
    public static function iswc(): string
    {
        return 'iswc';
    }

    /**
     * Adds the International Standard Musical Work Code (ISWC).
     *
     * @param ISWC $iswc The International Standard Musical Work Code (ISWC)
     *
     * @return static
     */
    public function addIswc(ISWC $iswc): static
    {
        $this->addTerm((string) $iswc, self::iswc());

        return $this;
    }
}
