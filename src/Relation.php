<?php

declare(strict_types=1);

namespace MusicBrainz;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Relation\Type;
use MusicBrainz\Value\Date;
use MusicBrainz\Value\Direction;
use MusicBrainz\Value\EntityType;

use function array_filter;
use function array_values;
use function is_int;
use function is_string;

/**
 * A relation
 */
abstract class Relation
{
    use \MusicBrainz\Value\Property\DirectionTrait;
    use \MusicBrainz\Value\Property\RelationTypeTrait;

    private Date $beginDate;

    private Date $endDate;

    private bool $ended;

    private ?int $orderingKey;

    private string $sourceCredit;

    private string $targetCredit;

    /** @var list<string> */
    private array $attributes;

    /** @var array<string,string> */
    private array $attributeIds;

    /** @var array<string,string> */
    private array $attributeValues;

    /** @var array<string,string> */
    private array $attributeCredits;

    /**
     * Constructs the relation.
     *
     * @param array $entity   Information about the related entity
     * @param array $relation Information about the relation itself (period, attributes, credits)
     */
    final public function __construct(array $entity, Type $relationType, Direction $direction, array $relation = [])
    {
        $this->setRelationType($relationType);
        $this->setDirection($direction);
        $this->setRelatedEntity($entity);

        $this->beginDate = new Date(ArrayAccess::getString($relation, 'begin') ?? '');
        $this->endDate = new Date(ArrayAccess::getString($relation, 'end') ?? '');
        $this->ended = ArrayAccess::getBool($relation, 'ended') ?? false;
        $this->orderingKey = ArrayAccess::getInteger($relation, 'ordering-key');
        $this->sourceCredit = ArrayAccess::getString($relation, 'source-credit') ?? '';
        $this->targetCredit = ArrayAccess::getString($relation, 'target-credit') ?? '';
        $this->attributes = array_values(array_filter(ArrayAccess::getArray($relation, 'attributes') ?? [], is_string(...)));
        $this->attributeIds = self::stringMap(ArrayAccess::getArray($relation, 'attribute-ids'));
        $this->attributeValues = self::stringMap(ArrayAccess::getArray($relation, 'attribute-values'));
        $this->attributeCredits = self::stringMap(ArrayAccess::getArray($relation, 'attribute-credits'));
    }

    /**
     * Returns the date the relation began.
     */
    public function getBeginDate(): Date
    {
        return $this->beginDate;
    }

    /**
     * Returns the date the relation ended.
     */
    public function getEndDate(): Date
    {
        return $this->endDate;
    }

    /**
     * Returns true, if the relation has ended.
     */
    public function isEnded(): bool
    {
        return $this->ended;
    }

    /**
     * Returns the position of the relation within an ordered list (e.g. of a series), if it has one.
     */
    public function getOrderingKey(): ?int
    {
        return $this->orderingKey;
    }

    /**
     * Returns the name the source entity is credited with in this relation (empty, if it is credited with its name).
     */
    public function getSourceCredit(): string
    {
        return $this->sourceCredit;
    }

    /**
     * Returns the name the target entity is credited with in this relation (empty, if it is credited with its name).
     */
    public function getTargetCredit(): string
    {
        return $this->targetCredit;
    }

    /**
     * Returns the names of the relation's attributes, e.g. "guitar", "lead vocals".
     *
     * @return list<string>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Returns the MBIDs of the attributes, indexed by attribute name.
     *
     * @return array<string,string>
     */
    public function getAttributeIds(): array
    {
        return $this->attributeIds;
    }

    /**
     * Returns the values of attributes that have one (e.g. a number), indexed by attribute name.
     *
     * @return array<string,string>
     */
    public function getAttributeValues(): array
    {
        return $this->attributeValues;
    }

    /**
     * Returns the credits of attributes (e.g. the instrument name as printed in the liner notes), indexed by attribute
     * name.
     *
     * @return array<string,string>
     */
    public function getAttributeCredits(): array
    {
        return $this->attributeCredits;
    }

    /**
     * @param null|array<mixed> $map
     *
     * @return array<string,string>
     */
    private static function stringMap(?array $map): array
    {
        $result = [];
        foreach ($map ?? [] as $key => $value) {
            if (is_string($value) || is_int($value)) {
                $result[(string) $key] = (string) $value;
            }
        }

        return $result;
    }

    /**
     * Sets the related entity.
     *
     * @param array $entity Information about the related entity
     *
     * @return void
     */
    abstract protected function setRelatedEntity(array $entity): void;

    /**
     * Returns the entity type of the related entity.
     *
     * @return null|EntityType
     */
    abstract public static function getRelatedEntityType(): ?EntityType;
}
