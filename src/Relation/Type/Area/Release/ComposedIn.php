<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the area it was composed in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/4a1d7968-4e3f-4293-a746-5051dd2596d5
 */
class ComposedIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Composed in');
    }
}
