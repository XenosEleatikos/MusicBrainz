<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\ReleaseType;

/**
 * Provides a getter for the primary release type.
 */
trait PrimaryReleaseTypeTrait
{
    /**
     * The primary release type
     *
     * @var ReleaseType
     */
    private $primaryReleaseType;

    /**
     * Returns the primary release type.
     *
     * @return ReleaseType
     */
    public function getPrimaryReleaseType(): ReleaseType
    {
        return $this->primaryReleaseType;
    }

    /**
     * Sets the primary release type by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setPrimaryReleaseTypeFromArray(array $input): void
    {
        $this->primaryReleaseType = is_null($primaryReleaseType = ArrayAccess::getString($input, 'primary-type'))
            ? new ReleaseType()
            : new ReleaseType($primaryReleaseType);
    }
}
