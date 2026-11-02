<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait ReleaseGroupIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release group.
     *
     * @return string
     *
     * @internal
     */
    public static function releaseGroupId(): string
    {
        return 'rgid';
    }

    /**
     * Adds the MusicBrainz ID (MBID) of the release group.
     *
     * @param MBID $releaseGroupId The MusicBrainz ID (MBID) of the release group
     *
     * @return static
     */
    public function addReleaseGroupId(MBID $releaseGroupId): static
    {
        $this->addTerm((string) $releaseGroupId, self::releaseGroupId());

        return $this;
    }
}
