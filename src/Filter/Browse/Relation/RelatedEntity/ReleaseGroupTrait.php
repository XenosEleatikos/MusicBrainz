<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a release group".
 */
trait ReleaseGroupTrait
{
    /**
     * Browses the entities linked to a release group.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the release group
     */
    public static function releaseGroup(MBID $mbid): static
    {
        return new static(BrowseParameter::ReleaseGroup, $mbid);
    }
}
