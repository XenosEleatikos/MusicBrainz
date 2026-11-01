<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;
use MusicBrainz\Value\Name;

/**
 * Links a competition event to an artist that was a participant in it.
 *
 * @link https://musicbrainz.org/relationship/74c225de-aaf5-41c0-bfc5-05a8f56bab5d
 */
class Participant extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Participant');
    }
}
