<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a collection".
 */
trait CollectionTrait
{
    /**
     * Browses the entities linked to a collection.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the collection
     */
    public static function collection(MBID $mbid): static
    {
        return new static(BrowseParameter::Collection, $mbid);
    }
}
