<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Series;

use MusicBrainz\Relation\Type\ReleaseGroup\Series;

/**
 * Links a release group to the event series (tour, residency, etc.) it was recorded during.
 *
 * @link https://musicbrainz.org/relationship/c610b838-612f-4d9d-8527-0e59849b7d7e
 */
class RecordedDuring extends Series
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'recorded during';
    }
}
