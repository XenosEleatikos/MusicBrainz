<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\MediumNumber;

trait MediumNumberTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the medium number.
     *
     * @return string
     */
    public static function mediumNumber(): string
    {
        return 'position';
    }

    /**
     * Adds the medium number.
     *
     * @param MediumNumber $mediumNumber The medium number
     *
     * @return static
     */
    public function addMediumNumber(MediumNumber $mediumNumber): static
    {
        $this->addTerm((string) $mediumNumber, self::mediumNumber());

        return $this;
    }
}
