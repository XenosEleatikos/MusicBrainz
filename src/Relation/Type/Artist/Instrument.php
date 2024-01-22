<?php

namespace MusicBrainz\Relation\Type\Artist;

use MusicBrainz\Value\EntityType;

/**
 * A relation of an artist to an instrument
 *
 * @link https://musicbrainz.org/relationships/artist-instrument
 */
abstract class Instrument extends \MusicBrainz\Relation\Type\Artist
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::INSTRUMENT);
    }
}
