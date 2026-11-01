<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the area its libretto was written in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/6e35e603-af14-4360-8c36-b080429f89e1
 */
class LibrettoWrittenIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('libretto written in');
    }
}
