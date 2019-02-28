<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A track number
 */
class TrackPositionNumber implements Value
{
    /**
     * The track position number
     *
     * @var null|int
     */
    private $number;

    /**
     * Constructs a position.
     *
     * @param int $position A track position number
     */
    public function __construct(?int $position = null)
    {
        $this->position = $position;
    }

    /**
     * Returns the track number as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return ($this->position) ? (string) $this->position : '';
    }
}
