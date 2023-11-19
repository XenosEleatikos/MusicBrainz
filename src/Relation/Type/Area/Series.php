<?php

namespace MusicBrainz\Relation\Type\Area;

use MusicBrainz\Value\EntityType;
use MusicBrainz\Relation\Type\Area;

/**
 * A relation between an area and a series
 *
 * @link https://musicbrainz.org/relationships/area-series
 */
abstract class Series extends Area
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::SERIES);
    }
}
