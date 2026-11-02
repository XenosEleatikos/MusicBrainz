<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Count;

trait NumberOfMediumsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the number of mediums.
     *
     * @return string
     *
     * @internal
     */
    public static function numberOfMediums(): string
    {
        return 'mediums';
    }

    /**
     * Adds the number of mediums.
     *
     * @param Count $numberOfMediums The number of mediums
     *
     * @return static
     */
    public function addNumberOfMediums(Count $numberOfMediums): static
    {
        $this->addTerm((string) $numberOfMediums, self::numberOfMediums());

        return $this;
    }
}
