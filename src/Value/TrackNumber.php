<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A track position number
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
     * Constructs a position.
     *
     * @param int $position A track position number
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
        return ($this->trackNumber) ? (int) $this->trackNumber : '0';
    }
}
