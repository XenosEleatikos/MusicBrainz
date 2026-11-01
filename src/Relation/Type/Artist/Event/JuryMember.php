<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;
use MusicBrainz\Value\Name;

/**
 * Links a competition event to an artist that was a jury member in it.
 *
 * @link https://musicbrainz.org/relationship/5193f001-643f-44a1-9fad-0f6816e84a3d
 */
class JuryMember extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Jury member');
    }
}
