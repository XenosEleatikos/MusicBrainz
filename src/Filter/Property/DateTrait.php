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
     *
     * @internal
     */
    public static function date(): string
    {
        return 'date';
    }

    /**
     * Adds the release date (of the release, or of any release that includes the recording).
     *
     * @param Date $date The release date
     *
     * @return static
     */
    public function addDate(Date $date): static
    {
        $this->addTerm((string) $date, self::date());

        return $this;
    }
}
