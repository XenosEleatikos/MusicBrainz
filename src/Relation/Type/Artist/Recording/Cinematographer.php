<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the artist was the cinematographer / director of photography for this video recording.
 *
 * @link https://musicbrainz.org/relationship/4b290951-ab5e-4605-a304-650aa1f35377
 */
class Cinematographer extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Cinematographer');
    }
}
