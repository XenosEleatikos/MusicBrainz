<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\NamedType;
use PHPUnit\Framework\Assert;

use function array_diff;
use function array_filter;
use function array_merge;
use function array_push;
use function array_key_exists;
use function array_values;
use function array_keys;
use function count;
use function get_debug_type;
use function in_array;
use function is_array;

/**
 * Compares a value object with the JSON it was built from. For every entity type there is an explicit table: each key of
 * the JSON must either be mapped to a property or be listed as deliberately not mapped. A key that is neither fails
 * the test, so data the library silently drops cannot go unnoticed.
 *
 * Kinds: str (string, '' if absent), nstr (?string), int (int, 0 if absent), nint (?int), bool, id (?MBID), date (?Date),
 * named (NamedType, the id comes from the key given as third element), strs (list<string>), ints (list<int>), list
 * (list of the type given as third element), entity (object of the type given as third element), skip (not mapped).
 */
final class EntityAssertions
{
    private const SHARED = [
        'aliases'     => ['aliases', 'list', 'alias'],
        'tags'        => ['tags', 'list', 'tag'],
        'genres'      => ['genres', 'list', 'genre'],
        'user-tags'   => ['userTags', 'list', 'tag'],
        'user-genres' => ['userGenres', 'list', 'genre'],
        'rating'      => ['rating', 'rating'],
        'user-rating' => ['userRating', 'userRating'],
        'annotation'  => ['annotation', 'nstr'],
        'relations'   => ['relations', 'relations'],
        'relation-list' => ['relations', 'relations'],
        'score'       => [null, 'skip'],
    ];

    /**
     * @var array<string, array<string, array{0: null|string, 1: string, 2?: string}>>
     */
    private const TABLE = [
        'area' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'sort-name' => ['sortName', 'nstr'], 'disambiguation' => ['disambiguation', 'str'],
            'type' => ['type', 'named', 'type-id'], 'type-id' => [null, 'skip'], 'iso-3166-1-codes' => ['iso31661Codes', 'strs'],
            'iso-3166-2-codes' => ['iso31662Codes', 'strs'], 'iso-3166-3-codes' => ['iso31663Codes', 'strs'], 'life-span' => ['lifeSpan', 'entity', 'life-span'],
        ],
        'artist' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'sort-name' => ['sortName', 'nstr'], 'disambiguation' => ['disambiguation', 'str'],
            'type' => ['type', 'named', 'type-id'], 'type-id' => [null, 'skip'], 'gender' => ['gender', 'named', 'gender-id'], 'gender-id' => [null, 'skip'],
            'country' => ['country', 'nstr'], 'area' => ['area', 'entity', 'area'], 'begin-area' => ['beginArea', 'entity', 'area'], 'end-area' => ['endArea', 'entity', 'area'],
            'begin_area' => ['beginArea', 'entity', 'area'], 'end_area' => ['endArea', 'entity', 'area'],
            'life-span' => ['lifeSpan', 'entity', 'life-span'], 'ipis' => ['ipis', 'strs'], 'isnis' => ['isnis', 'strs'],
            'releases' => ['releases', 'list', 'release'], 'release-groups' => ['releaseGroups', 'list', 'release-group'],
            'recordings' => ['recordings', 'list', 'recording'], 'works' => ['works', 'list', 'work'],
        ],
        'event' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'type' => ['type', 'named', 'type-id'],
            'type-id' => [null, 'skip'], 'time' => ['time', 'nstr'], 'cancelled' => ['cancelled', 'bool'], 'setlist' => ['setlist', 'str'],
            'life-span' => ['lifeSpan', 'entity', 'life-span'],
        ],
        'instrument' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'type' => ['type', 'named', 'type-id'],
            'type-id' => [null, 'skip'], 'description' => ['description', 'str'],
        ],
        'label' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'sort-name' => ['sortName', 'nstr'], 'disambiguation' => ['disambiguation', 'str'],
            'type' => ['type', 'named', 'type-id'], 'type-id' => [null, 'skip'], 'country' => ['country', 'nstr'], 'area' => ['area', 'entity', 'area'],
            'label-code' => ['labelCode', 'nint'], 'ipis' => ['ipis', 'strs'], 'isnis' => ['isnis', 'strs'], 'life-span' => ['lifeSpan', 'entity', 'life-span'],
            'releases' => ['releases', 'list', 'release'],
        ],
        'place' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'type' => ['type', 'named', 'type-id'],
            'type-id' => [null, 'skip'], 'address' => ['address', 'str'], 'coordinates' => ['coordinates', 'entity', 'coordinates'], 'area' => ['area', 'entity', 'area'],
            'life-span' => ['lifeSpan', 'entity', 'life-span'],
        ],
        'recording' => [
            'id' => ['id', 'id'], 'title' => ['title', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'length' => ['length', 'nint'],
            'first-release-date' => ['firstReleaseDate', 'date'], 'artist-credit' => ['artistCredits', 'list', 'artist-credit'], 'artist-credit-id' => ['artistCreditId', 'id'],
            'video' => ['video', 'bool'], 'isrcs' => ['isrcs', 'strs'], 'releases' => ['releases', 'list', 'release'],
        ],
        'release' => [
            'id' => ['id', 'id'], 'title' => ['title', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'status' => ['status', 'named', 'status-id'],
            'status-id' => [null, 'skip'], 'packaging' => ['packaging', 'named', 'packaging-id'], 'packaging-id' => [null, 'skip'], 'quality' => ['quality', 'quality'],
            'text-representation' => ['textRepresentation', 'entity', 'text-representation'], 'artist-credit' => ['artistCredits', 'list', 'artist-credit'], 'artist-credit-id' => ['artistCreditId', 'id'],
            'release-group' => ['releaseGroup', 'entity', 'release-group'], 'date' => ['date', 'date'], 'country' => ['country', 'nstr'],
            'release-events' => ['releaseEvents', 'list', 'release-event'], 'barcode' => ['barcode', 'nstr'], 'asin' => ['asin', 'nstr'],
            'label-info' => ['labelInfos', 'list', 'label-info'], 'media' => ['media', 'list', 'medium'], 'cover-art-archive' => ['coverArtArchive', 'entity', 'cover-art-archive'],
            'collections' => ['collections', 'list', 'collection'],
            // Deliberately not mapped
            'track-count' => [null, 'skip'], 'label-info-count' => [null, 'skip'], 'count' => [null, 'skip'],
        ],
        'release-group' => [
            'id' => ['id', 'id'], 'title' => ['title', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'primary-type' => ['primaryType', 'named', 'primary-type-id'],
            'primary-type-id' => [null, 'skip'], 'secondary-types' => ['secondaryTypes', 'secondary'], 'secondary-type-ids' => [null, 'skip'],
            'artist-credit' => ['artistCredits', 'list', 'artist-credit'], 'artist-credit-id' => ['artistCreditId', 'id'], 'first-release-date' => ['firstReleaseDate', 'date'], 'releases' => ['releases', 'list', 'release'],
            // Search results: the number of releases, which is the length of the list
            'count' => [null, 'skip'],
            'type' => [null, 'skip'], 'type-id' => [null, 'skip'],
        ],
        'series' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'type' => ['type', 'named', 'type-id'], 'type-id' => [null, 'skip'],
        ],
        'work' => [
            'id' => ['id', 'id'], 'title' => ['title', 'str'], 'disambiguation' => ['disambiguation', 'str'], 'type' => ['type', 'named', 'type-id'], 'type-id' => [null, 'skip'],
            'language' => ['language', 'nstr'], 'languages' => ['languages', 'strs'], 'iswcs' => ['iswcs', 'strs'], 'attributes' => ['attributes', 'list', 'attribute'],
        ],
        'url' => [
            'id' => ['id', 'id'], 'resource' => ['resource', 'str'], 'relations' => ['relations', 'relations'], 'relation-list' => ['relations', 'relations'], 'score' => [null, 'skip'],
        ],
        'collection' => [
            'id' => ['id', 'id'], 'name' => ['name', 'str'], 'editor' => ['editor', 'str'], 'entity-type' => ['entityType', 'entityType'], 'type' => ['type', 'nstr'],
            'type-id' => [null, 'skip'], 'artist-count' => [null, 'skip'], 'release-count' => [null, 'skip'], 'area-count' => [null, 'skip'], 'event-count' => [null, 'skip'],
            'instrument-count' => [null, 'skip'], 'label-count' => [null, 'skip'], 'place-count' => [null, 'skip'], 'recording-count' => [null, 'skip'],
            'release-group-count' => [null, 'skip'], 'series-count' => [null, 'skip'], 'work-count' => [null, 'skip'], 'genre-count' => [null, 'skip'],
        ],
        'annotation' => [
            'entity' => ['entityId', 'id'], 'name' => ['name', 'str'], 'text' => ['text', 'str'], 'type' => ['entityType', 'entityType'], 'score' => [null, 'skip'],
        ],
        'cdstub' => [
            'id' => ['discId', 'str'], 'title' => ['title', 'str'], 'artist' => ['artist', 'str'], 'barcode' => ['barcode', 'str'],
            'disambiguation' => ['disambiguation', 'str'], 'count' => ['trackCount', 'nint'], 'score' => [null, 'skip'],
        ],
        'tag' => ['name' => ['name', 'str'], 'count' => ['count', 'int'], 'score' => [null, 'skip']],
        'genre' => ['id' => ['id', 'id'], 'name' => ['name', 'str'], 'count' => ['count', 'int'], 'disambiguation' => ['disambiguation', 'str']],
        'alias' => [
            'name' => ['name', 'str'], 'sort-name' => ['sortName', 'nstr'], 'type' => ['type', 'named', 'type-id'], 'type-id' => [null, 'skip'], 'locale' => ['locale', 'nstr'],
            'primary' => ['primary', 'bool'], 'begin' => ['begin', 'date'], 'begin-date' => ['begin', 'date'], 'end' => ['end', 'date'], 'end-date' => ['end', 'date'], 'ended' => ['ended', 'bool'],
        ],
        'life-span' => ['begin' => ['begin', 'date'], 'end' => ['end', 'date'], 'ended' => ['ended', 'bool']],
        'text-representation' => ['language' => ['language', 'nstr'], 'script' => ['script', 'nstr']],
        'cover-art-archive' => [
            'artwork' => ['artwork', 'bool'], 'count' => ['count', 'int'], 'front' => ['front', 'bool'], 'back' => ['back', 'bool'], 'darkened' => ['darkened', 'bool'],
        ],
        'coordinates' => ['latitude' => ['latitude', 'float'], 'longitude' => ['longitude', 'float']],
        'artist-credit' => ['name' => ['name', 'str'], 'joinphrase' => ['joinPhrase', 'str'], 'artist' => ['artist', 'entity', 'artist']],
        'medium' => [
            'id' => ['id', 'id'], 'position' => ['position', 'nint'], 'title' => ['title', 'str'], 'format' => ['format', 'nstr'], 'format-id' => ['formatId', 'id'],
            'track-count' => ['trackCount', 'nint'], 'disc-count' => ['discCount', 'nint'], 'track-offset' => [null, 'skip'], 'track' => ['tracks', 'list', 'track'], 'discs' => ['discs', 'list', 'disc'], 'tracks' => ['tracks', 'list', 'track'],
        ],
        'disc' => ['id' => ['id', 'str'], 'sectors' => ['sectors', 'nint'], 'offsets' => ['offsets', 'ints'], 'offset-count' => [null, 'skip']],
        'track' => [
            'id' => ['id', 'id'], 'title' => ['title', 'str'], 'number' => ['number', 'nstr'], 'position' => ['position', 'nint'], 'length' => ['length', 'nint'],
            'artist-credit' => ['artistCredits', 'list', 'artist-credit'], 'recording' => ['recording', 'entity', 'recording'],
        ],
        'release-event' => ['date' => ['date', 'date'], 'area' => ['area', 'entity', 'area']],
        'label-info' => ['catalog-number' => ['catalogNumber', 'nstr'], 'label' => ['label', 'entity', 'label']],
        'attribute' => ['type' => ['type', 'str'], 'type-id' => ['typeId', 'id'], 'value' => ['value', 'nstr'], 'value-id' => ['valueId', 'id']],
    ];

    private const RELATION_KEYS = [
        'type', 'type-id', 'direction', 'target-type', 'target', 'begin', 'end', 'ended', 'attributes', 'attribute-ids', 'attribute-values',
        'attribute-credits', 'source-credit', 'target-credit', 'ordering-key',
    ];

    /** Types whose JSON does not carry the shared keys (aliases, tags, ...) */
    private const WITHOUT_SHARED = [
        'url', 'collection', 'annotation', 'cdstub', 'tag', 'genre', 'alias', 'life-span', 'text-representation', 'cover-art-archive', 'coordinates',
        'artist-credit', 'medium', 'disc', 'track', 'release-event', 'label-info', 'attribute',
    ];

    /**
     * @param array<string,mixed> $json
     */
    public static function assertMirrors(?object $object, string $type, array $json, string $path = ''): void
    {
        $path = '' === $path ? $type : $path;
        Assert::assertNotNull($object, "$path: expected an object");
        $table = self::TABLE[$type] + (in_array($type, self::WITHOUT_SHARED, true) ? [] : self::SHARED);

        $unmapped = array_diff(array_keys($json), array_keys($table));
        Assert::assertSame([], array_values($unmapped), "$path: keys of the response the library does not read (add the property or list the key as skipped)");

        $checked = [];
        foreach ($table as $key => $definition) {
            [$property, $kind] = $definition;
            if ('skip' === $kind || !array_key_exists($key, $json)) {
                continue;
            }
            self::assertProperty($object, (string) $property, $kind, $definition[2] ?? null, $json, $key, "$path.$key");
            $checked[$property] = true;
        }

        if ('collection' === $type && isset($json['entity-type'])) {
            Assert::assertSame($json[$json['entity-type'] . '-count'] ?? 0, $object->count, "$path: number of entities in the collection");
        }

        // What the response does not contain must be empty in the object
        foreach ($table as $key => $definition) {
            [$property, $kind] = $definition;
            if ('skip' !== $kind && !isset($checked[$property])) {
                self::assertAbsent($object, (string) $property, $kind, "$path.$key");
                $checked[$property] = true;
            }
        }
    }

    /**
     * @param array<string,mixed> $json
     */
    private static function assertProperty(object $object, string $property, string $kind, ?string $argument, array $json, string $key, string $path): void
    {
        $actual = $object->$property;
        $value = $json[$key] ?? null;

        switch ($kind) {
            case 'str':
                Assert::assertSame(null === $value ? '' : (string) $value, $actual, $path);
                break;
            case 'nstr':
                Assert::assertSame(null === $value ? null : (string) $value, $actual, $path);
                break;
            case 'entityType':
                Assert::assertSame(null === $value ? null : str_replace('-', '_', (string) $value), $actual?->value, $path);
                break;
            case 'int':
            case 'nint':
                Assert::assertSame(null === $value ? ('int' === $kind ? 0 : null) : (int) $value, $actual, $path);
                break;
            case 'float':
                Assert::assertSame((float) $value, $actual, $path);
                break;
            case 'bool':
                Assert::assertSame((bool) $value, $actual, $path);
                break;
            case 'id':
                Assert::assertSame(null === $value || '' === $value ? null : (string) $value, null === $actual ? null : (string) $actual, $path);
                break;
            case 'date':
                Assert::assertSame(null === $value || '' === $value ? null : (string) $value, null === $actual ? null : (string) $actual, $path);
                break;
            case 'named':
                if (null === $value) {
                    Assert::assertNull($actual, $path);
                    break;
                }
                Assert::assertInstanceOf(NamedType::class, $actual, $path);
                Assert::assertSame($value, $actual->name, "$path name");
                Assert::assertSame($json[$argument] ?? null, null === $actual->id ? null : (string) $actual->id, "$path id");
                Assert::assertNotNull($actual->kind(), "$path: {$actual->name} is not a known kind");
                break;
            case 'quality':
                Assert::assertSame($value, $actual?->value, $path);
                break;
            case 'strs':
                Assert::assertSame(array_values($value ?? []), $actual, $path);
                break;
            case 'ints':
                Assert::assertSame(array_values($value ?? []), $actual, $path);
                break;
            case 'secondary':
                Assert::assertCount(count($value ?? []), $actual, $path);
                foreach ($value ?? [] as $index => $name) {
                    Assert::assertSame($name, $actual[$index]->name, $path);
                    Assert::assertNotNull($actual[$index]->kind(), "$path: $name is not a known kind");
                    Assert::assertSame($json['secondary-type-ids'][$index] ?? null, null === $actual[$index]->id ? null : (string) $actual[$index]->id, $path);
                }
                break;
            case 'entity':
                if (null === $value || [] === $value) {
                    Assert::assertNull($actual, $path);
                    break;
                }
                self::assertMirrors($actual, (string) $argument, $value, $path);
                break;
            case 'list':
                Assert::assertIsArray($actual, $path);
                Assert::assertCount(count($value ?? []), $actual, "$path: number of elements");
                foreach ($value ?? [] as $index => $element) {
                    self::assertMirrors($actual[$index], (string) $argument, $element, "{$path}[{$index}]");
                }
                break;
            case 'rating':
                if (!isset($value['value'])) {
                    Assert::assertNull($actual, $path);
                    break;
                }
                Assert::assertSame((float) $value['value'], $actual->value, $path);
                Assert::assertSame((int) ($value['votes-count'] ?? 0), $actual->votes, $path);
                break;
            case 'userRating':
                Assert::assertSame($value['value'] ?? null, $actual, $path);
                break;
            case 'relations':
                Assert::assertNotNull($actual, "$path: relations were delivered but not parsed");
                self::assertRelations($actual, 'relation-list' === $key ? self::flatten($value) : $value, $path);
                break;
            default:
                Assert::fail("Unknown kind $kind");
        }
    }

    /**
     * Search results deliver the relations as "relation-list": [{"relations": [...]}].
     *
     * @param array<int,array<string,mixed>> $lists
     *
     * @return list<array<string,mixed>>
     */
    private static function flatten(array $lists): array
    {
        $relations = [];
        foreach ($lists as $list) {
            array_push($relations, ...($list['relations'] ?? []));
        }

        return $relations;
    }

    /**
     * Every relation of a type the library knows must arrive, in the order of the response, with its own data and its
     * target; every key of the response must be known.
     *
     * @param array<int,array<string,mixed>> $json
     */
    public static function assertRelations(\MusicBrainz\Relation\RelationList $list, array $json, string $path): void
    {
        $known = RelationTypeId::getClassMap();
        $expected = array_values(array_filter($json, static fn(array $relation): bool => isset($known[$relation['type-id']])));
        Assert::assertCount(count($expected), $list->relations, "$path: relations of known types must not get lost");

        $keys = array_merge(self::RELATION_KEYS, array_map(static fn(EntityType $type): string => $type->value, EntityType::cases()));
        foreach ($expected as $index => $relationJson) {
            $at = "{$path}.relations[{$index}]";
            $relation = $list->relations[$index];
            Assert::assertSame([], array_values(array_diff(array_keys($relationJson), $keys)), "$at: keys of the response the library does not read");

            Assert::assertSame($relationJson['direction'], $relation->direction->value, $at);
            Assert::assertSame($relationJson['type-id'], (string) $relation->type::getRelationTypeId(), $at);
            Assert::assertSame($relationJson['type'], (string) $relation->type::getRelationName(), "$at: the name of the relation type");
            Assert::assertSame($relationJson['begin'] ?? null, null === $relation->begin ? null : (string) $relation->begin, $at);
            Assert::assertSame($relationJson['end'] ?? null, null === $relation->end ? null : (string) $relation->end, $at);
            Assert::assertSame($relationJson['ended'] ?? false, $relation->ended, $at);
            Assert::assertSame($relationJson['ordering-key'] ?? null, $relation->orderingKey, $at);
            Assert::assertSame($relationJson['source-credit'] ?? '', $relation->sourceCredit, $at);
            Assert::assertSame($relationJson['target-credit'] ?? '', $relation->targetCredit, $at);
            Assert::assertSame($relationJson['attributes'] ?? [], $relation->attributes, $at);
            Assert::assertSame($relationJson['attribute-ids'] ?? [], $relation->attributeIds, $at);
            Assert::assertSame($relationJson['attribute-values'] ?? [], $relation->attributeValues, $at);
            Assert::assertSame($relationJson['attribute-credits'] ?? [], $relation->attributeCredits, $at);

            Assert::assertArrayHasKey($relation->targetType->value, $relationJson, "$at: the target is delivered under its entity type");
            self::assertMirrors($relation->target, $relation->targetType->path(), $relationJson[$relation->targetType->value], "$at.target");
        }
    }

    private static function assertAbsent(object $object, string $property, string $kind, string $path): void
    {
        if ('float' === $kind) {
            return;
        }
        $expected = match ($kind) {
            'str' => '',
            'int' => 0,
            'bool' => false,
            'list', 'strs', 'ints', 'secondary' => [],
            default => null,
        };
        $actual = $object->$property;
        Assert::assertSame($expected, $actual, "$path is absent in the response, so the property must be " . get_debug_type($expected));
    }

    /**
     * @return list<string> The entity types the tables know
     */
    public static function types(): array
    {
        return array_keys(self::TABLE);
    }

    public static function isList(mixed $value): bool
    {
        return is_array($value) && array_is_list($value);
    }
}
