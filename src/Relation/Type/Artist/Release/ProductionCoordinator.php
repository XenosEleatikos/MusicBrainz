<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release;

use MusicBrainz\Relation\Type\Artist\Release as Base;
use MusicBrainz\Value\Name;

/**
 * Links a release to a person credited as a production coordinator for it.
 *
 * @link https://musicbrainz.org/relationship/65e417c8-c76b-4fef-af6d-6a5a515d181f
 */
class ProductionCoordinator extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Production coordinator');
    }
}
