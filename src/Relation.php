<?php

declare(strict_types=1);

namespace MusicBrainz;

use LogicException;
use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Relation\Type;
use MusicBrainz\Value\Area;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\Date;
use MusicBrainz\Value\Direction;
use MusicBrainz\Value\Entity;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\Event;
use MusicBrainz\Value\Genre;
use MusicBrainz\Value\Instrument;
use MusicBrainz\Value\Label;
use MusicBrainz\Value\Place;
use MusicBrainz\Value\Recording;
use MusicBrainz\Value\Release;
use MusicBrainz\Value\ReleaseGroup;
use MusicBrainz\Value\Series;
use MusicBrainz\Value\URL;
use MusicBrainz\Value\Work;

use function array_filter;
use function array_key_exists;
use function array_values;
use function is_string;
use function is_int;

/**
 * A relationship between two entities, seen from the entity it was requested with: the target is the entity on the
 * other side, the direction tells in which direction the relationship type reads.
 *
 * @see https://musicbrainz.org/doc/Relationships
 */
final readonly class Relation
{
    /**
     * @param MBID                 $typeId           The MBID of the relationship type
     * @param string               $typeName         The name of the relationship type as the web service delivers it
     * @param null|Type            $type             The class of the relationship type; null if the library does not know it yet
     * @param list<string>         $attributes       Names of the attributes, e.g. "guitar" or "lead vocals"
     * @param array<string,string> $attributeIds     MBIDs of the attributes, by name
     * @param array<string,string> $attributeValues  Values of attributes that have one (e.g. a number), by name
     * @param array<string,string> $attributeCredits Credits of attributes (e.g. the instrument as printed in the liner notes), by name
     */
    public function __construct(
        public MBID $typeId,
        public string $typeName,
        public ?Type $type,
        public Direction $direction,
        public EntityType $targetType,
        public Entity $target,
        public ?Date $begin = null,
        public ?Date $end = null,
        public bool $ended = false,
        public ?int $orderingKey = null,
        public string $sourceCredit = '',
        public string $targetCredit = '',
        public array $attributes = [],
        public array $attributeIds = [],
        public array $attributeValues = [],
        public array $attributeCredits = [],
    ) {}

    /**
     * Builds a relation from a decoded "relations" element. Relationships of a type the library does not know yet are kept
     * (`$type` is null) and reported to the logger. Returns null, and logs a warning, only if the relation is incomplete.
     *
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function tryFromArray(array $data): ?self
    {
        $typeId = Json::id($data, 'type-id');
        $typeName = ArrayAccess::getString($data, 'type') ?? '';
        $directionName = ArrayAccess::getString($data, 'direction');
        $direction = null === $directionName ? null : Direction::tryFrom($directionName);

        if (null === $typeId || null === $direction) {
            MusicBrainz::log()->warning('Cannot resolve the relation "' . $typeName . '" without a valid type id and direction (got "' . ($directionName ?? 'null') . '")');

            return null;
        }

        $type = self::type($typeId);
        if (null === $type) {
            MusicBrainz::log()->warning('Unknown relation type "' . $typeName . '". See: https://musicbrainz.org/relationship/' . $typeId);
        }

        // The target is delivered under the key of its entity type; there is exactly one such key
        $targetType = null;
        $targetData = null;
        foreach (EntityType::cases() as $candidateType) {
            $candidate = EntityType::Collection === $candidateType ? null : ArrayAccess::getArray($data, $candidateType->value);
            if (!empty($candidate)) {
                $targetType = $candidateType;
                $targetData = $candidate;
                break;
            }
        }

        if (null === $targetType || null === $targetData) {
            MusicBrainz::log()->warning('Cannot resolve the relation "' . $typeName . '": there is no target. See: https://musicbrainz.org/relationship/' . $typeId);

            return null;
        }

        return new self(
            $typeId,
            $typeName,
            $type,
            $direction,
            $targetType,
            self::target($targetType, $targetData),
            Json::date($data, 'begin'),
            Json::date($data, 'end'),
            ArrayAccess::getBool($data, 'ended') ?? false,
            ArrayAccess::getInteger($data, 'ordering-key'),
            ArrayAccess::getString($data, 'source-credit') ?? '',
            ArrayAccess::getString($data, 'target-credit') ?? '',
            array_values(array_filter(ArrayAccess::getArray($data, 'attributes') ?? [], is_string(...))),
            self::strings(ArrayAccess::getArray($data, 'attribute-ids')),
            self::strings(ArrayAccess::getArray($data, 'attribute-values')),
            self::strings(ArrayAccess::getArray($data, 'attribute-credits')),
        );
    }

    private static function type(MBID $typeId): ?Type
    {
        $classMap = RelationTypeId::getClassMap();
        if (!array_key_exists((string) $typeId, $classMap)) {
            return null;
        }
        $class = $classMap[(string) $typeId];

        return new $class();
    }

    /**
     * @param array<mixed> $data
     */
    private static function target(EntityType $type, array $data): Entity
    {
        return match ($type) {
            EntityType::Area         => Area::fromArray($data),
            EntityType::Artist       => Artist::fromArray($data),
            EntityType::Event        => Event::fromArray($data),
            EntityType::Genre        => Genre::fromArray($data),
            EntityType::Instrument   => Instrument::fromArray($data),
            EntityType::Label        => Label::fromArray($data),
            EntityType::Place        => Place::fromArray($data),
            EntityType::Recording    => Recording::fromArray($data),
            EntityType::Release      => Release::fromArray($data),
            EntityType::ReleaseGroup => ReleaseGroup::fromArray($data),
            EntityType::Series       => Series::fromArray($data),
            EntityType::Url          => URL::fromArray($data),
            EntityType::Work         => Work::fromArray($data),
            default                  => throw new LogicException('Relations to ' . $type->value . ' are not supported'),
        };
    }

    /**
     * @param null|array<mixed> $map
     *
     * @return array<string,string>
     */
    private static function strings(?array $map): array
    {
        $result = [];
        foreach ($map ?? [] as $key => $value) {
            if (is_string($value) || is_int($value)) {
                $result[(string) $key] = (string) $value;
            }
        }

        return $result;
    }
}
