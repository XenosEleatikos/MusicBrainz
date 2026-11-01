<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\ReleaseStatus;

/**
 * Provides a getter for the release status.
 */
trait ReleaseStatusTrait
{
    private ?ReleaseStatus $releaseStatus;

    /**
     * Returns the release status, or null if the web service did not deliver one.
     */
    public function getReleaseStatus(): ?ReleaseStatus
    {
        return $this->releaseStatus;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setReleaseStatusFromArray(array $input): void
    {
        $this->releaseStatus = ReleaseStatus::fromArray($input, 'status', 'status-id');
    }
}
