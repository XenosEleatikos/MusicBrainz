<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\Date;

trait EndDateTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the ending date.
     *
     * @return string
     */
    public static function endDate(): string
    {
        return 'end';
    }

    /**
     * Adds the ending date.
     *
     * @param Date $endDate The ending date
     *
     * @return static
     */
    public function addEndDate(Date $endDate): static
    {
        $this->addTerm((string) $endDate, self::endDate());

        return $this;
    }
}
