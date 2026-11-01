<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/c33b8c5c-52aa-49a9-8cb7-7c70b960d17d
 */
class Production extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Production');
    }
}
