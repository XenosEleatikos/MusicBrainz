<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\TrackPositionNumber;

/**
 * Provides a getter for a track position number.
 */
trait TrackPositionNumberTrait
{
    /**
     * The displayed track position number
     *
     * @var TrackPositionNumber
     */
    public $trackPositionNumber;

    /**
     * Returns the displayed track position number.
     *
     * @return TrackPositionNumber
     */
    public function getTrackPositionNumber(): TrackPositionNumber
    {
        return $this->trackPositionNumber;
    }

    /**
     * Sets the displayed track position number by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setTrackPositionNumberFromArray(array $input): void
    {
        $this->trackPositionNumber = is_null($trackPositionNumber = ArrayAccess::getString($input, 'position'))
            ? new TrackPositionNumber
            : new TrackPositionNumber($trackPositionNumber);
    }
}
