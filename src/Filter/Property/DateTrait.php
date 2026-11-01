<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\Date;

trait DateTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the date.
     *
     * @return string
     */
    public static function date(): string
    {
        return 'date';
    }

    /**
     * Adds the recording release date.
     *
     * @param Date $date The recording release date
     *
     * @return static
     */
    public function addDate(Date $date): static
    {
        $this->addTerm((string) $date, self::date());

        return $this;
    }
}
