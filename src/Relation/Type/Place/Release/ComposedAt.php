<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the place it was composed at.
 *
 * @link https://musicbrainz.org/relationship/8f1e3ee5-9415-4b63-a31c-174d99410fcd
 */
class ComposedAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Composed at');
    }
}
