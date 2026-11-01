<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release;

use MusicBrainz\Relation\Type\Artist\Release;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/d6b8f1d2-5431-4c97-9688-44f73213ee5b
 */
class RemixesAndCompilations extends Release
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
