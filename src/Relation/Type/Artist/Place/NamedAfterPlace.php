<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place;

use MusicBrainz\Relation\Type\Artist\Place as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the place that inspired this artist’s name.
 *
 * @link https://musicbrainz.org/relationship/f58cff57-79e2-4c34-9312-6bd9f43c97c6
 */
class NamedAfterPlace extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('named after place');
    }
}
