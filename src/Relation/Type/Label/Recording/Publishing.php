<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording;
use MusicBrainz\Value\Name;

/**
 * This relationship is deprecated. To indicate work publishers, add label-work relationships. To indicate (P) holders,
 * use the phonographic copyright relationship.
 *
 * @link https://musicbrainz.org/relationship/51e4a303-8215-4db6-9a9f-ebe95442dbef
 */
class Publishing extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('publishing');
    }
}
