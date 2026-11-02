<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Value\MBID;

/**
 * Provides the relation "linked to a label".
 */
trait LabelTrait
{
    /**
     * Browses the entities linked to a label.
     *
     * @param MBID $mbid The MusicBrainz Identifier (MBID) of the label
     */
    public static function label(MBID $mbid): static
    {
        return new static(BrowseParameter::Label, $mbid);
    }
}
