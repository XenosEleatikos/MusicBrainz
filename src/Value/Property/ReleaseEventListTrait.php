<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\ReleaseEvent;
use MusicBrainz\Value\ReleaseEventList;

/**
 * Provides a getter for a release event list.
 */
trait ReleaseEventListTrait
{
    /**
     * A list of release events
     *
     * @var ReleaseEvent[]|ReleaseEventList
     */
    private $releaseEventList;

    /**
     * Returns the list of release events.
     *
     * @return ReleaseEvent[]|ReleaseEventList
     */
    public function getReleaseEvents(): ReleaseEventList
    {
        return $this->releaseEventList;
    }

    /**
     * Sets a list of release events by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setReleaseEventsFromArray(array $input): void
    {
        $this->releaseEventList = is_null($releaseEventList = ArrayAccess::getArray($input, 'release-events'))
            ? new ReleaseEventList()
            : new ReleaseEventList($releaseEventList);
    }
}
