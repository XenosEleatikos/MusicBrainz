<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait ReleaseIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release ID.
     *
     * @return string
     */
    public static function releaseId(): string
    {
        return 'reid';
    }

    /**
     * Adds the MusicBrainz ID of a release.
     *
     * @param MBID $releaseId The MusicBrainz ID of a release
     *
     * @return static
     */
    public function addReleaseId(MBID $releaseId): static
    {
        $this->addTerm((string) $releaseId, self::releaseId());

        return $this;
    }
}
