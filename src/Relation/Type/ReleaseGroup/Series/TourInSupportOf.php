<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Series;

use MusicBrainz\Relation\Type\ReleaseGroup\Series;

/**
 * This links a concert tour with a release group (generally an album) the tour is connected with.
 *
 * @link https://musicbrainz.org/relationship/72e1f4d8-011b-49ab-bba4-6990981c972e
 */
class TourInSupportOf extends Series
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'tour in support of';
    }
}
