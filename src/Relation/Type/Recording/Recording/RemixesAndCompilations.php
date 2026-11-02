<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording;

use MusicBrainz\Relation\Type\Recording\Recording;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/1baddd63-4539-4d49-ae43-600df9ef4647
 */
class RemixesAndCompilations extends Recording
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
