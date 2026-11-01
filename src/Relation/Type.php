<?php

declare(strict_types=1);

namespace MusicBrainz\Relation;

use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Value\EntityType;
use LogicException;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Name;

use function is_string;

/**
 * A relation type
 */
abstract class Type
{
    /**
     * Returns the entity type of the base entity, null for an unknown relation type.
     *
     * @return null|EntityType
     */
    abstract public static function getBaseEntityType(): ?EntityType;

    /**
     * Returns the entity type of the related entity, null for an unknown relation type.
     *
     * @return null|EntityType
     */
    abstract public static function getRelatedEntityType(): ?EntityType;

    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    abstract public static function getRelationName(): Name;

    /**
     * Returns the UUID of the relation.
     *
     * @return MBID
     */
    final public static function getRelationTypeId(): MBID
    {
        $id = array_search(static::class, RelationTypeId::getClassMap(), true);

        if (!is_string($id)) {
            throw new LogicException(static::class . ' is not part of the map of relation types');
        }

        return new MBID($id);
    }
}
