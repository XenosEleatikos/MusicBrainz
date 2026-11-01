<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/5b3ecc42-64ca-4685-8877-a2621f370c35
 */
class Production extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Production');
    }
}
