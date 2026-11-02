<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Series;

use MusicBrainz\Relation\Type\Release\Series;

/**
 * Indicates that the release is part of a series.
 *
 * @link https://musicbrainz.org/relationship/3fa29f01-8e13-3e49-9b0a-ad212aa2f81d
 */
class PartOf extends Series
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'part of';
    }
}
