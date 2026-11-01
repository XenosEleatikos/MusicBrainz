<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates an artist who provided artwork for the event when no more specific information is available.
 *
 * @link https://musicbrainz.org/relationship/a66ea135-5dd0-4dc2-8ecb-59e3026d1ecc
 */
class Artwork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('artwork');
    }
}
