<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a work".
 */
trait WorkTrait
{
    /**
     * Browses the entities linked to a work.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the work
     */
    public static function work(MBID $mbid): static
    {
        return new static(BrowseParameter::Work, $mbid);
    }
}
