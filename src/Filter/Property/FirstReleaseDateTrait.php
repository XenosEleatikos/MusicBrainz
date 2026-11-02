<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\Date;

trait FirstReleaseDateTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the release date of the earliest release including this recording or in this release group.
     *
     * @return string
     *
     * @internal
     */
    public static function firstReleaseDate(): string
    {
        return 'firstreleasedate';
    }

    /**
     * Searches for the release date of the earliest release including this recording or in this release group (e.g. "1980-01-22").
     *
     * @param Date $date
     *
     * @return static
     */
    public function addFirstReleaseDate(Date $date): static
    {
        $this->addTerm((string) $date, self::firstReleaseDate());

        return $this;
    }
}
