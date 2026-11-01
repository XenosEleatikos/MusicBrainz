<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Work;

use MusicBrainz\Relation\Type\Area\Work as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates that the area commissioned the work. This is most common for classical works, but also exists in
 * other genres to a degree.
 *
 * @link https://musicbrainz.org/relationship/7345634d-64aa-4e1f-985a-89942b4a674b
 */
class Commissioned extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('commissioned');
    }
}
