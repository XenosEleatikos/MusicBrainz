<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A track position number
 */
class TrackPositionNumber implements Value
{
    /**
     * The track position number
     *
     * @var null|int
     */
    private $trackPositionNumber;

    /**
     * Constructs a position.
     *
     * @param int $position A track position number
     */
    public function __construct(?int $trackPositionNumber = null)
    {
        $this->trackPositionNumber = $trackPositionNumber;
    }

    /**
     * Returns the track position number as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return ($this->trackPositionNumber) ? (string) $this->trackPositionNumber : '';
    }
}
