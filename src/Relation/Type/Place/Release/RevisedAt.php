<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the place it was revised at.
 *
 * @link https://musicbrainz.org/relationship/8c9790a7-3704-4329-8ed9-eb4f50233e66
 */
class RevisedAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('revised at');
    }
}
