<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * An element of a search result: the entity and how well it matches the query.
 *
 * @template T of object
 */
final readonly class SearchResult
{
    /**
     * @param T   $entity Contains the data the search found, which is less than a lookup delivers
     * @param int $score  0 to 100
     */
    public function __construct(
        public object $entity,
        public int $score,
    ) {}

    /**
     * @template E of Parsable
     *
     * @param array<mixed>    $data  A decoded element of the result list
     * @param class-string<E> $class A class with a static fromArray(array): E factory
     *
     * @return self<E>
     *
     * @internal
     */
    public static function from(array $data, string $class): self
    {
        /** @var E $entity */
        $entity = $class::fromArray($data);

        return new self($entity, ArrayAccess::getInteger($data, 'score') ?? 0);
    }
}
