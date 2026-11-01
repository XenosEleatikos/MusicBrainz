<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release;
use MusicBrainz\Value\Name;

/**
 * This links a release with the place it was arranged at.
 *
 * @link https://musicbrainz.org/relationship/03a9e95d-986f-40e4-985d-7487bfccfbb2
 */
class ArrangedAt extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('arranged at');
    }
}
