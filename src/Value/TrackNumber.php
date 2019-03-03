<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A track number
 */
class TrackNumber implements Value
{
    /**
     * The track position number
     *
     * @var null|int
     */
    private $trackNumber;

    /**
     * Constructs a track position number.
     *
     * @param int $number A track number
     */
    public function __construct(?int $trackNumber = 0)
    {
        $this->trackNumber = $trackNumber;
    }

    /**
     * Returns the track position number as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return ($this->trackNumber) ? (string) $this->trackNumber : '';
    }
}
