<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Count;

trait NumberOfDiscIdsOnMediumTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the number of disc IDs on a medium.
     *
     * @return string
     */
    public static function numberOfDiscIdsOnMedium(): string
    {
        return 'discidsmedium';
    }

    /**
     * Adds the number of cd ids for the release on a medium in the release.
     *
     * @param Count $numberOfDiscIdsOnMedium The number of cd ids for the release on a medium in the release
     *
     * @return static
     */
    public function addNumberOfDiscIdsOnMedium(Count $numberOfDiscIdsOnMedium): static
    {
        $this->addTerm((string) $numberOfDiscIdsOnMedium, self::numberOfDiscIdsOnMedium());

        return $this;
    }
}
