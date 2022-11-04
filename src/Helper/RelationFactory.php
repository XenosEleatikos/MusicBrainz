<?php

namespace MusicBrainz\Helper;

use MusicBrainz\Definition\RelationTarget;
use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Relation;
use MusicBrainz\Relation\NullType;
use MusicBrainz\Relation\Type;
use MusicBrainz\Value\Direction;
use MusicBrainz\Value\MBID;

/**
 * The relation factory
 */
class RelationFactory
{
    use \MusicBrainz\Value\Property\AreaTrait;

    /**
     * Makes and returns a relation by given information from the webservice.
     *
     * @param array $relation Information about the relation
     *
     * @return Relation
     */
    public static function make(array $relation = []): Relation
    {
        $relationTypeId = ArrayAccess::getString($relation, 'type-id');

        /** @var Type $relationType */
        $relationType = self::getRelationType(new MBID($relationTypeId));

        if ($relationType instanceof NullType) {
            /** @todo Implement fallback for undefined relation */
        }

        $direction = new Direction(ArrayAccess::getString($relation, 'direction'));



        $relatedEntityType = (Direction::FORWARD == $direction)
            ? $relationType::getRelatedEntityType()
            : $relationType::getBaseEntityType();

        $class = RelationTarget::getClassMap()[(string) $relatedEntityType];

        if (is_null($relation[(string) $relatedEntityType])) {
            /** @todo Implement fallback for undefined relation */
            die;
        }

        return new $class(
            $relation[(string) $relatedEntityType],
            $relationType,
            $direction
        );
    }

    /**
     * Returns a relation type by its MusicBrainz Identifier (MBID).
     *
     * @param MBID $relationTypeId The MusicBrainz Identifier (MBID) of the relation type.
     *
     * @return Type
     */
    private static function getRelationType(MBID $relationTypeId): Type
    {
        $classMap = RelationTypeId::getClassMap();

        if (array_key_exists((string) $relationTypeId, $classMap)) {
            $relationType = RelationTypeId::getClassMap()[(string) $relationTypeId];

            return new $relationType();
        }

        return new NullType();
    }
}
