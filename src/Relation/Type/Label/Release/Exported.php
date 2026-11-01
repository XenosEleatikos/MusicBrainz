<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the organization that exports (or contracts out exports). This is not the same concept as the record label .
 *
 * @link https://musicbrainz.org/relationship/7a3eb822-71a5-4530-b8a9-dd2d55a3d440
 */
class Exported extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Exported');
    }
}
