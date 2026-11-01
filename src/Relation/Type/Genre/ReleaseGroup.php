<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Genre;

use MusicBrainz\Value\EntityType;

/**
 * A relation of a genre to a release group
 *
 * @link https://musicbrainz.org/relationships/genre-release-group
 */
abstract class ReleaseGroup extends \MusicBrainz\Relation\Type\Genre
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return EntityType::ReleaseGroup;
    }
}
