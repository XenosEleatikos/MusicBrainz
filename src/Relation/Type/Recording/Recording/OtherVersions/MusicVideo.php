<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording\OtherVersions;

use MusicBrainz\Relation\Type\Recording\Recording\OtherVersions;

/**
 * This is used to link a music video to the corresponding audio recording.
 *
 * @link https://musicbrainz.org/relationship/ce3de655-7451-44d1-9224-87eb948c205d
 */
class MusicVideo extends OtherVersions
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'music video';
    }
}
