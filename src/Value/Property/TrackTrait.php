<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\Track;

/**
 * Provides a getter for a track.
 */
trait TrackTrait
{
    /**
     * The track number
     *
     * @var Track
     */
    public $track;

    /**
     * Returns the track.
     *
     * @return Track
     */
    public function getTrack(): Track
    {
        return $this->track;
    }
}
