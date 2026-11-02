<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a recording".
 */
trait RecordingTrait
{
    /**
     * Browses the entities linked to a recording.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the recording
     */
    public static function recording(MBID $mbid): static
    {
        return new static(BrowseParameter::Recording, $mbid);
    }
}
