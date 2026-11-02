<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist;

use MusicBrainz\Value\EntityType;

/**
 * A relation of an artist to a genre
 *
 * @link https://musicbrainz.org/relationships/artist-genre
 */
abstract class Genre extends \MusicBrainz\Relation\Type\Artist
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return EntityType::Genre;
    }
}
