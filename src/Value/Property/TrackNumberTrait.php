<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\TrackNumber;

/**
 * Provides a getter for a track position number.
 */
trait TrackNumberTrait
{
    /**
     * The displayed track position number
     *
     * @var TrackPositionNumber
     */
    public $trackNumber;

    /**
     * Returns the displayed track position number.
     *
     * @return TrackPositionNumber
     */
    public function getTrackNumber(): TrackNumber
    {
        return $this->trackNumber;
    }

    /**
     * Sets the displayed track position number by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setTrackNumberFromArray(array $input): void
    {
        $this->trackNumber = is_null($trackNumber = ArrayAccess::getInteger($input, 'position'))
            ? new TrackNumber
            : new TrackNumber($trackNumber);
    }
}
