<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Count;

trait NumberOfDiscIdsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the number of disc IDs.
     *
     * @return string
     *
     * @internal
     */
    public static function numberOfDiscIds(): string
    {
        return 'discids';
    }

    /**
     * Adds the total number of cd ids over all mediums for the release.
     *
     * @param Count $numberOfDiscIds The total number of cd ids over all mediums for the release
     *
     * @return static
     */
    public function addNumberOfDiscIds(Count $numberOfDiscIds): static
    {
        $this->addTerm((string) $numberOfDiscIds, self::numberOfDiscIds());

        return $this;
    }
}
