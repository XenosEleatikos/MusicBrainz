<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work;

use MusicBrainz\Relation\Type\Artist\Work as Base;
use MusicBrainz\Value\Name;

/**
 * Indicates the person who wrote an original script for a dramatized work, such as an audio drama.
 *
 * @link https://musicbrainz.org/relationship/154b11b0-0784-4b04-8af8-04eccb7ebc56
 */
class Scriptwriter extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Scriptwriter');
    }
}
