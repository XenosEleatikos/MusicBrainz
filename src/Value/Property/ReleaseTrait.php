<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\Release;

/**
 * Provides a getter for a release.
 */
trait ReleaseTrait
{
    /**
     * The release number
     *
     * @var Release
     */
    public $release;

    /**
     * Returns the release.
     *
     * @return Release
     */
    public function getRelease(): Release
    {
        return $this->release;
    }

}
