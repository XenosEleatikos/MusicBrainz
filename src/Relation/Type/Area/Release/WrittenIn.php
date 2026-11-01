<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the area it was written in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/6c799b93-556e-41b8-853d-3b8320786eaa
 */
class WrittenIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Written in');
    }
}
