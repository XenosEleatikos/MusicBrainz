<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A track number as displayed on a release
 */
class TrackDisplayNumber implements Value
{
    /**
     * The displayed track number
     *
     * @var null|string
     */
    private $trackDisplayNumber;

    /**
     * Constructs a barcode.
     *
     * @param null|string $trackNumber The displayed track number
     */
    public function __construct(?string $trackDisplayNumber = null)
    {
        $this->trackDisplayNumber = $trackDisplayNumber;
    }

    /**
     * Returns the track number as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return ($this->trackDisplayNumber) ? $this->trackDisplayNumber : '';
    }
}
