<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates an artist who did illustration for a video recording.
 *
 * @link https://musicbrainz.org/relationship/0c73d6e6-d741-4098-9d74-e8da0c63fe14
 */
class Illustration extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Illustration');
    }
}
