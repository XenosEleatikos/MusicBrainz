<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a release".
 */
trait ReleaseTrait
{
    /**
     * Browses the entities linked to a release.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the release
     */
    public static function release(MBID $mbid): static
    {
        return new static(BrowseParameter::Release, $mbid);
    }
}
