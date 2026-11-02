<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Count;

trait ReleaseCountTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the amount of releases related to the label.
     *
     * @return string
     *
     * @internal
     */
    public static function releaseCount(): string
    {
        return 'release_count';
    }

    /**
     * Searches for the amount of releases related to the label.
     *
     * @param Count $count
     *
     * @return static
     */
    public function addReleaseCount(Count $count): static
    {
        $this->addTerm((string) $count, self::releaseCount());

        return $this;
    }
}
