<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates an artist who did design for the event.
 *
 * @link https://musicbrainz.org/relationship/c49495bf-71d0-4d5f-9121-c775cc33e940
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
