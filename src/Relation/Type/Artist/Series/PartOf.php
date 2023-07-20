<?php

namespace MusicBrainz\Relation\Type\Artist\Series;

use MusicBrainz\Relation\Type\Artist\Release;
use MusicBrainz\Value\Name;

/**
 * A "part of" relation
 * This relationship is used to indicate that the artist is part of a series.
 *
 * @link https://musicbrainz.org/relationship/d1a845d1-8c03-3191-9454-e4e8d37fa5e0
 */
class PartOf extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('part of');
    }
}
