<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\ReleaseStatus;

/**
 * Provides a getter for a release status.
 */
trait ReleaseStatusTrait
{
    /**
     * The release status
     *
     * @var ReleaseStatus
     */
    private ReleaseStatus $releaseStatus;

    /**
     * Returns the release status.
     *
     * @return ReleaseStatus
     */
    public function getReleaseStatus(): ReleaseStatus
    {
        return $this->releaseStatus;
    }

    /**
     * Sets the release status by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setReleaseStatusFromArray(array $input): void
    {
        $releaseStatus   = ArrayAccess::getString($input, 'status');
        $releaseStatusId = ArrayAccess::getString($input, 'status-id');

        $this->releaseStatus = (is_null($releaseStatus) && is_null($releaseStatusId))
            ? new ReleaseStatus()
            : new ReleaseStatus($releaseStatus, new MBID($releaseStatusId ?: ''));
    }
}
