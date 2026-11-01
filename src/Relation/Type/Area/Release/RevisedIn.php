<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the area it was revised in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/e2866d42-d86f-49ab-ba26-e05276d858f6
 */
class RevisedIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Revised in');
    }
}
