<?php

declare(strict_types=1);

namespace MusicBrainz\Relation;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use MusicBrainz\Relation;
use MusicBrainz\Value\EntityType;
use Traversable;

use function array_filter;
use function array_values;
use function count;
use function is_array;

/**
 * The relationships of an entity, in the order of the web service. Relationships of types the library does not know
 * are left out (and logged).
 *
 * @implements IteratorAggregate<int, Relation>
 */
final readonly class RelationList implements Countable, IteratorAggregate
{
    /**
     * @param list<Relation> $relations
     */
    public function __construct(public array $relations = []) {}

    /**
     * @param array<mixed> $relations Decoded "relations" elements
     */
    public static function fromArray(array $relations): self
    {
        $result = [];
        foreach ($relations as $data) {
            $relation = is_array($data) ? Relation::fromArray($data) : null;
            if (null !== $relation) {
                $result[] = $relation;
            }
        }

        return new self($result);
    }

    /**
     * Returns the relations to entities of a type, e.g. all relations to artists.
     *
     * @return list<Relation>
     */
    public function to(EntityType $targetType): array
    {
        return array_values(array_filter($this->relations, static fn(Relation $relation): bool => $relation->targetType === $targetType));
    }

    public function count(): int
    {
        return count($this->relations);
    }

    /**
     * @return Traversable<int, Relation>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->relations);
    }
}
