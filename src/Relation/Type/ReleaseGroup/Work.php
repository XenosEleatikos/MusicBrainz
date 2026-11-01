<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup;

use MusicBrainz\Value\EntityType;

/**
 * A relation of a release group to a work
 *
 * @link https://musicbrainz.org/relationships/release-group-work
 */
abstract class Work extends \MusicBrainz\Relation\Type\ReleaseGroup
{
    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    final public static function getRelatedEntityType(): EntityType
    {
        return EntityType::Work;
    }
}
