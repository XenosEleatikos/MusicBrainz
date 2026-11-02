<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'composed in';
    }
}
