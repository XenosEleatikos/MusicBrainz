<?php

declare(strict_types=1);

namespace MusicBrainz\Helper;

use MusicBrainz\InvalidArgumentException;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Value\Date;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Parsable;

use function array_filter;
use function array_values;
use function is_int;
use function get_debug_type;
use function is_array;
use function is_string;

/**
 * Reads typed values out of decoded JSON. Missing keys and null values give null (or an empty list); values of the
 * wrong type are reported to the logger by {@see ArrayAccess}.
 *
 * @internal
 */
final class Json
{
    /**
     * @template T of Parsable
     *
     * @param array<mixed>    $data
     * @param class-string<T> $class
     *
     * @return null|T
     */
    public static function object(array $data, string $key, string $class): ?object
    {
        $value = ArrayAccess::getArray($data, $key);

        return null === $value ? null : $class::fromArray($value);
    }

    /**
     * @template T of Parsable
     *
     * @param array<mixed>    $data
     * @param class-string<T> $class A class with a static fromArray(array): T factory
     *
     * @return list<T>
     */
    public static function list(array $data, string $key, string $class): array
    {
        $result = [];
        foreach (ArrayAccess::getArray($data, $key) ?? [] as $element) {
            if (is_array($element)) {
                $result[] = $class::fromArray($element);
            } else {
                MusicBrainz::log()->error('Unexpected API behavior: an element of "' . $key . '" is of type ' . get_debug_type($element) . ', expected an object');
            }
        }

        return $result;
    }

    /**
     * @param array<mixed> $data
     *
     * @return list<string>
     */
    public static function strings(array $data, string $key): array
    {
        $result = [];
        foreach (ArrayAccess::getArray($data, $key) ?? [] as $element) {
            if (is_string($element)) {
                $result[] = $element;
            }
        }

        return $result;
    }

    /**
     * @param array<mixed> $data
     *
     * @return list<int>
     */
    public static function integers(array $data, string $key): array
    {
        return array_values(array_filter(ArrayAccess::getArray($data, $key) ?? [], is_int(...)));
    }

    /**
     * @param array<mixed> $data
     */
    public static function id(array $data, string $key = 'id'): ?MBID
    {
        $id = ArrayAccess::getString($data, $key);
        if (null === $id || '' === $id) {
            return null;
        }

        try {
            return new MBID($id);
        } catch (InvalidArgumentException) {
            MusicBrainz::log()->error('Unexpected API behavior: "' . $id . '" in "' . $key . '" is not an MBID');

            return null;
        }
    }

    /**
     * @param array<mixed> $data
     */
    public static function date(array $data, string $key): ?Date
    {
        $date = ArrayAccess::getString($data, $key);

        return null === $date || '' === $date ? null : Date::tryFrom($date);
    }
}
