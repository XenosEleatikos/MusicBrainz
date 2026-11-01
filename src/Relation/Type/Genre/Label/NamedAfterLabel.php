<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Genre\Label;

use MusicBrainz\Relation\Type\Genre\Label as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the label that inspired this genre’s name.
 *
 * @link https://musicbrainz.org/relationship/b80f8b51-2212-415a-9ed1-bb5636b96d02
 */
class NamedAfterLabel extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Named after label');
    }
}
