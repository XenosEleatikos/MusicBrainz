<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait InstrumentIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the MBID of the instrument.
     *
     * @return string
     *
     * @internal
     */
    public static function instrumentId(): string
    {
        return 'iid';
    }

    /**
     * Searches for the MBID of the instrument.
     *
     * @param MBID $instrumentId
     *
     * @return static
     */
    public function addInstrumentId(MBID $instrumentId): static
    {
        $this->addTerm((string) $instrumentId, self::instrumentId());

        return $this;
    }
}
