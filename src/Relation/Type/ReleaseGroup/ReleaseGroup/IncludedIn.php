<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup;

use MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup;

/**
 * This indicates that a release group was included in another. This allows linking release groups (often albums) to
 * box sets and other compilations that contain them.
 *
 * @link https://musicbrainz.org/relationship/589447ea-be2c-46cc-b9e9-469e1d06e18a
 */
class IncludedIn extends ReleaseGroup
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'included in';
    }
}
