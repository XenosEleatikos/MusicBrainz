<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Release;

use MusicBrainz\Relation\Type\Recording\Release;

/**
 * Indicates that the recording contains samples from this release.
 *
 * @link https://musicbrainz.org/relationship/967746f9-9d79-456c-9d1e-50116f0b27fc
 */
class SamplesMaterial extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'samples material';
    }
}
