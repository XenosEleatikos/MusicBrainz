<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates an artist who did design for a video recording.
 *
 * @link https://musicbrainz.org/relationship/d860c4da-16ea-419f-94c6-bc545a09143f
 */
class Design extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('design');
    }
}
