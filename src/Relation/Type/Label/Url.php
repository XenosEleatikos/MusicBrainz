<?php

namespace MusicBrainz\Relation\Type\Label;

use MusicBrainz\Value\EntityType;

/**
 * A relation of a label to an url
 *
 * @link https://musicbrainz.org/relationships/label-url
 */
abstract class Url extends \MusicBrainz\Relation\Type\Label
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::URL);
    }
}
