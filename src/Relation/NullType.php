<?php

declare(strict_types=1);

namespace MusicBrainz\Relation;

use MusicBrainz\Value\EntityType;

/**
 * An undefined relation type
 */
class NullType extends Type
{
    /**
     * Returns the entity type of the base entity.
     *
     * @return null|EntityType
     */
    public static function getBaseEntityType(): ?EntityType
    {
        return null;
    }

    /**
     * Returns the entity type of the related entity.
     *
     * @return null|EntityType
     */
    public static function getRelatedEntityType(): ?EntityType
    {
        return null;
    }

    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'is related to';
    }
}
