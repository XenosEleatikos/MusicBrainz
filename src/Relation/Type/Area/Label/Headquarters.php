<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Label;

use MusicBrainz\Relation\Type\Area\Label as Base;

/**
 * This indicates the area (usually a city) where a label is headquartered in.
 *
 * @link https://musicbrainz.org/relationship/c28aa691-74de-4c4c-acc3-348611d7e857
 */
class Headquarters extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'headquarters';
    }
}
