<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording\OtherVersions;

use MusicBrainz\Relation\Type\Recording\Recording\OtherVersions;

/**
 * This relationship type is deprecated! If two recordings are identical, please merge them.
 *
 * @link https://musicbrainz.org/relationship/f5f41b82-ecc7-488e-adf3-12356885d724
 */
class FirstTrackRelease extends OtherVersions
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'first track release';
    }
}
