<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Label;

use MusicBrainz\Relation\Type\Artist\Label;
use MusicBrainz\Value\Name;

/**
 * This indicates that an artist was officially employed by a label in a position not covered by any more specific
 * relationship. Specify the position using the “Task” attribute.
 *
 * @link https://musicbrainz.org/relationship/e74a40e7-0f27-4e05-bdbd-eb10f5309472
 */
class Contract extends Label
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('position at');
    }
}
