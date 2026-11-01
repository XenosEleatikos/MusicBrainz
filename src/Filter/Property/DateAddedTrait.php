<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\Date;

trait DateAddedTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the date the CD stub was added.
     *
     * @return string
     */
    public static function dateAdded(): string
    {
        return 'added';
    }

    /**
     * Searches for the date the CD stub was added (e.g. "2020-01-22").
     *
     * @param Date $date
     *
     * @return static
     */
    public function addDateAdded(Date $date): static
    {
        $this->addTerm((string) $date, self::dateAdded());

        return $this;
    }
}
