<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Release;

use MusicBrainz\Relation\Type\Release\Release;
use MusicBrainz\Value\Name;

/**
 * This relationship type is deprecated! Please enter a release with multiple discs as a single release containing
 * multiple discs.
 *
 * @link https://musicbrainz.org/relationship/6d08ec1e-a292-4dac-90f3-c398a39defd5
 */
class PartOfSet extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('part of set');
    }
}
