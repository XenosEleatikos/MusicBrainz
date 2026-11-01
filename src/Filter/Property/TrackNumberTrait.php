<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\TrackNumber;

trait TrackNumberTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the track number.
     *
     * @return string
     */
    public static function trackNumber(): string
    {
        return 'tnum';
    }

    /**
     * Adds the track number.
     *
     * @param TrackNumber $trackNumber The track number
     *
     * @return static
     */
    public function addTrackNumber(TrackNumber $trackNumber): static
    {
        $this->addTerm((string) $trackNumber, self::trackNumber());

        return $this;
    }
}
