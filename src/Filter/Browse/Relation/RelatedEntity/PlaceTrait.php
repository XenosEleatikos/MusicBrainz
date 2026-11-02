<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a place".
 */
trait PlaceTrait
{
    /**
     * Browses the entities linked to a place.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the place
     */
    public static function place(MBID $mbid): static
    {
        return new static(BrowseParameter::Place, $mbid);
    }
}
