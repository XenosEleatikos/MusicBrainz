<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Release;

use MusicBrainz\Relation\Type\Release\Release;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'part of set';
    }
}
