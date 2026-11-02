<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a track".
 */
trait TrackTrait
{
    /**
     * Browses the entities linked to a track.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the track
     */
    public static function track(MBID $mbid): static
    {
        return new static(BrowseParameter::Track, $mbid);
    }
}
