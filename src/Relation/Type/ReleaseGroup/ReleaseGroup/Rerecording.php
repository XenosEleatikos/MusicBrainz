<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup;

use MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup as Base;
use MusicBrainz\Value\Name;

/**
 * This relationship type is used to indicate that a release group is a re‐recording of another release group, that is, when an artist performs a new studio rendition of their own album.
 *
 * @link https://musicbrainz.org/relationship/26ce3301-cf1f-4ce4-a7e2-9670f9a9e1d5
 */
class Rerecording extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Re‐recording');
    }
}
