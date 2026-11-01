<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to an artist credited on a track".
 */
trait TrackArtistTrait
{
    /**
     * Browses the entities linked to an artist credited on a track.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the track artist
     */
    public static function trackArtist(MBID $mbid): static
    {
        return new static(BrowseParameter::TrackArtist, $mbid);
    }
}
