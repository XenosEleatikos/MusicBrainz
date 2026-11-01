<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This credits a person or agency who worked on animation for a video recording.
 *
 * @link https://musicbrainz.org/relationship/fd33dadb-a588-40f4-8055-32373f1bd19b
 */
class Animation extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Animation');
    }
}
