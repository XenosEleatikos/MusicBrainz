<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to an event".
 */
trait EventTrait
{
    /**
     * Browses the entities linked to an event.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the event
     */
    public static function event(MBID $mbid): static
    {
        return new static(BrowseParameter::Event, $mbid);
    }
}
