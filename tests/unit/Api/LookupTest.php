<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Test\Support\EntityFields;
use MusicBrainz\Test\Support\RecordedApi;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_filter;
use function count;
use function str_starts_with;

use const ARRAY_FILTER_USE_KEY;

/**
 * Lookups of every recorded entity (minimal and with all includes): the value object must mirror the JSON.
 */
final class LookupTest extends TestCase
{
    /**
     * JSON key of a list => getter, per entity.
     */
    private const LISTS = [
        'artist'  => ['aliases' => 'getAliases', 'releases' => 'getReleases', 'release-groups' => 'getReleaseGroups', 'tags' => 'getTags'],
        'area'    => ['aliases' => 'getAliases'],
        'label'   => ['aliases' => 'getAliases'],
        'series'  => ['aliases' => 'getAliases'],
    ];

    /**
     * @param list<string> $messages
     *
     * @return list<string>
     */
    private static function withoutKnownGaps(array $messages): array
    {
        return array_values(array_filter($messages, static fn(string $message): bool => !str_contains($message, 'Unknown relation type given')));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function lookups(): array
    {
        $names = array_keys(array_filter(RecordedApi::scenarios(), static fn(string $name): bool => str_starts_with($name, 'lookup/'), ARRAY_FILTER_USE_KEY));

        return array_combine($names, array_map(static fn(string $name): array => [$name], $names));
    }

    #[DataProvider('lookups')]
    public function testValueMirrorsJson(string $scenario): void
    {
        $api = new RecordedApi();
        $entity = RecordedApi::scenarios()[$scenario]($api->musicBrainz);
        $json = $api->lastResponse();
        $type = explode('/', $scenario)[1];
        $type = 'releaseGroup' === $type ? 'release-group' : $type;

        EntityFields::assertDetails($entity, $json);
        EntityFields::assertStructure($entity, $json);
        foreach (EntityFields::SCALARS[$type] as $key => $getter) {
            $actual = $entity->$getter();
            if (isset($json[$key]) && '' !== $json[$key]) {
                self::assertSame((string) $json[$key], (string) $actual, "$getter() must return $key");
            } else {
                self::assertSame('', null === $actual ? '' : (string) $actual, "$getter() must be empty if $key is");
            }
        }

        foreach (self::LISTS[$type] ?? [] as $key => $getter) {
            self::assertCount(count($json[$key] ?? []), $entity->$getter(), "$getter() must have all elements of $key");
        }

        self::assertSame([], self::withoutKnownGaps($api->logged), 'The library logged problems');
    }

    #[DataProvider('lookups')]
    public function testRelationsAreSortedByTargetType(string $scenario): void
    {
        $api = new RecordedApi();
        $entity = RecordedApi::scenarios()[$scenario]($api->musicBrainz);
        $json = $api->lastResponse();
        if (!method_exists($entity, 'getRelations')) {
            self::markTestSkipped('No relations');
        }

        $expected = [];
        $known = RelationTypeId::getClassMap();
        foreach ($json['relations'] ?? [] as $relation) {
            if (!isset($known[$relation['type-id']])) {
                continue; // a relation type the library does not know yet, see KNOWN_GAPS of ScenarioTest
            }
            $type = str_replace('_', '-', $relation['target-type']);
            $expected[$type] = ($expected[$type] ?? 0) + 1;
        }
        $relations = $entity->getRelations();
        $actual = [];
        foreach (['area', 'artist', 'event', 'instrument', 'label', 'place', 'recording', 'release', 'release-group', 'series', 'url', 'work'] as $type) {
            $getter = 'get' . str_replace('-', '', ucwords($type, '-')) . 'Relations';
            if (method_exists($relations, $getter) && count($relations->$getter()) > 0) {
                $actual[$type] = count($relations->$getter());
            }
        }

        self::assertSame($expected, $actual);
    }
}
