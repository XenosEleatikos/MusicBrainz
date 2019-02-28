<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\TrackNumber;

/**
 * Provides a getter for a track number.
 */
trait TrackNumberTrait
{
    /**
     * The displayed track number
     *
     * @var TrackNumber
     */
    public $trackNumber;

    /**
     * Returns the displayed track number.
     *
     * @return TrackNumber
     */
    public function getTrackNumber(): TrackNumber
    {
        return $this->trackNumber;
    }

    /**
     * Sets the displayed track number by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setTrackNumberFromArray(array $input): void
    {
        $this->trackNumber = is_null($trackNumber = ArrayAccess::getString($input, 'position'))
            ? new TrackNumber
            : new TrackNumber($trackNumber);
    }
}
