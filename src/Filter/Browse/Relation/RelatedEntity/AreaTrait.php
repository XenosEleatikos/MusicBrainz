<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to an area".
 */
trait AreaTrait
{
    /**
     * Browses the entities linked to an area.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the area
     */
    public static function area(MBID $mbid): static
    {
        return new static(BrowseParameter::Area, $mbid);
    }
}
