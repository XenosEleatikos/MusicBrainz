<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use MusicBrainz\Exception;
use MusicBrainz\MusicBrainz;
use Traversable;

use function array_key_exists;
use function count;
use function get_debug_type;
use function is_array;
use function is_int;
use function is_string;
use function var_export;
use function str_ends_with;

/**
 * A page of the elements a browse or search request found. Pages are immutable.
 *
 * @template T of object
 *
 * @implements ArrayAccess<int, T>
 * @implements IteratorAggregate<int, T>
 */
final readonly class Page implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * @param list<T>     $items      The elements of this page
     * @param int         $totalCount The number of all elements the request matches
     * @param int         $offset     The position of the first element of this page
     * @param null|string $created    The time the search index delivered the result (search only)
     */
    public function __construct(
        public array $items,
        public int $totalCount,
        public int $offset = 0,
        public ?string $created = null,
    ) {}

    /**
     * @template E of Parsable
     *
     * @param array<mixed>    $result A decoded browse response
     * @param class-string<E> $class
     *
     * @return self<E>
     *
     * @internal
     */
    public static function browse(array $result, string $type, string $class): self
    {
        $items = [];
        foreach (self::elements($result, $type) as $element) {
            $items[] = $class::fromArray($element);
        }

        return new self(
            $items,
            self::number($result, $type . '-count'),
            self::number($result, $type . '-offset'),
        );
    }

    /**
     * @template E of Parsable
     *
     * @param array<mixed>    $result A decoded search response
     * @param class-string<E> $class
     *
     * @return self<SearchResult<E>>
     *
     * @internal
     */
    public static function search(array $result, string $type, string $class): self
    {
        $items = [];
        foreach (self::elements($result, $type) as $element) {
            $items[] = SearchResult::fromArray($element, $class);
        }

        return new self(
            $items,
            self::number($result, 'count'),
            self::number($result, 'offset'),
            is_string($result['created'] ?? null) ? $result['created'] : null,
        );
    }

    /**
     * The elements on this page.
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return Traversable<int, T>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    /**
     * @return T
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset] ?? throw new Exception('There is no element at position ' . var_export($offset, true));
    }

    public function offsetSet(mixed $offset, mixed $value): never
    {
        throw new Exception('A page is immutable');
    }

    public function offsetUnset(mixed $offset): never
    {
        throw new Exception('A page is immutable');
    }

    /**
     * @param array<mixed> $result
     *
     * @return list<array<mixed>>
     */
    private static function elements(array $result, string $type): array
    {
        $key = str_ends_with($type, 's') ? $type : $type . 's';
        $list = $result[$key] ?? null;

        if (!is_array($list)) {
            MusicBrainz::log()->error('Unexpected API behavior: the response has no list "' . $key . '" (got ' . get_debug_type($list) . ')');

            return [];
        }

        $elements = [];
        foreach ($list as $element) {
            if (is_array($element)) {
                $elements[] = $element;
            } else {
                MusicBrainz::log()->error('Unexpected API behavior: an element of "' . $key . '" is of type ' . get_debug_type($element) . ', expected an object');
            }
        }

        return $elements;
    }

    /**
     * @param array<mixed> $result
     */
    private static function number(array $result, string $key): int
    {
        $number = $result[$key] ?? null;
        if (!is_int($number)) {
            MusicBrainz::log()->error('Unexpected API behavior: "' . $key . '" is missing or not an integer (got ' . get_debug_type($number) . ')');

            return 0;
        }

        return $number;
    }
}
