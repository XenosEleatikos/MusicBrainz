<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Event;

use MusicBrainz\Relation\Type\Area\Event;

/**
 * Links an event to the area where it was held. Use only if the exact place is unknown.
 *
 * @link https://musicbrainz.org/relationship/542f8484-8bc7-3ce5-a022-747850b2b928
 */
class HeldIn extends Event
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'held in';
    }
}
