<?php

namespace MusicBrainz\Relation\Type\Area;

use MusicBrainz\Value\EntityType;

/**
 * A relation of an area to a work
 *
 * @link https://musicbrainz.org/relationships/area-work
 */
abstract class Work extends \MusicBrainz\Relation\Type\Area
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::WORK);
    }
}
