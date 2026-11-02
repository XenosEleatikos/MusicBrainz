<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup;

use MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/3494ba38-4ac5-40b6-aa6f-4ac7546cd104
 */
class RemixesAndCompilations extends ReleaseGroup
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'remixes and compilations';
    }
}
