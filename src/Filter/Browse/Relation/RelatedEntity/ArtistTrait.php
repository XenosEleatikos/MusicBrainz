<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to an artist".
 */
trait ArtistTrait
{
    /**
     * Browses the entities linked to an artist.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the artist
     */
    public static function artist(MBID $mbid): static
    {
        return new static(BrowseParameter::Artist, $mbid);
    }
}
