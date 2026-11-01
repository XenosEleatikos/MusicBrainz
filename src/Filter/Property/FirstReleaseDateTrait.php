<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\Date;

trait FirstReleaseDateTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the release date of the earliest release including this recording or in this release group.
     *
     * @return string
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
     * @return Term
     */
    public function addFirstReleaseDate(Date $date): Term
    {
        return $this->addTerm((string) $date, self::firstReleaseDate());
    }
}
