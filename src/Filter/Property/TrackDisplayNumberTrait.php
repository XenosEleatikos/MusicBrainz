<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\TrackDisplayNumber;

trait TrackDisplayNumberTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the displayed track number.
     *
     * @return string
     */
    public static function trackDisplayNumber(): string
    {
        return 'number';
    }

    /**
     * Adds a displayed track number.
     *
     * @param TrackDisplayNumber $trackDisplayNumber A displayed track number
     *
     * @return static
     */
    public function addTrackDisplayNumber(TrackDisplayNumber $trackDisplayNumber): static
    {
        $this->addPhrase((string) $trackDisplayNumber, self::trackId());

        return $this;
    }
}
