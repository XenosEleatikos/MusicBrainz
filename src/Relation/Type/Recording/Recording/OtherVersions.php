<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording;

use MusicBrainz\Relation\Type\Recording\Recording;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/6a76ad99-cc5d-4ebc-a6e4-b2eb2eb3ad98
 */
class OtherVersions extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'other versions';
    }
}
