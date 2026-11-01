<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
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
     * @return Term
     */
    public function addDateAdded(Date $date): Term
    {
        return $this->addTerm((string) $date, self::dateAdded());
    }
}
