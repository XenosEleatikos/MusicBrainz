<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Series;

use MusicBrainz\Relation\Type\Artist\Series;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/d6cbe0fd-e457-4387-a7ec-450cd0a4e293
 */
class WorkCataloguing extends Series
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'work cataloguing';
    }
}
