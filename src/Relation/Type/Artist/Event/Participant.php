<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'participant';
    }
}
