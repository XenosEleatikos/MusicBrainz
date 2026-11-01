<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates an artist who did illustration for the event.
 *
 * @link https://musicbrainz.org/relationship/f10e1176-4644-4689-910f-16356946ff32
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
