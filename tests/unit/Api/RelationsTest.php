<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Test\Support\EntityAssertions;
use MusicBrainz\Test\Support\RecordedApi;
use MusicBrainz\Value\EntityType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function str_replace;
use function count;

/**
 * The relationships of every recorded lookup: each one of a known type must arrive with its target and its own data.
 */
final class RelationsTest extends TestCase
{
    /**
     * @return array<string, array{string}>
     */
    public static function lookups(): array
    {
        return LookupTest::lookups();
    }

    #[DataProvider('lookups')]
    public function testRelationsArriveWithTheirData(string $scenario): void
    {
        $api = new RecordedApi();
        $entity = RecordedApi::scenarios()[$scenario]($api->musicBrainz);
        $json = $api->lastResponse();

        if (!isset($json['relations'])) {
            self::assertNull($entity->relations ?? null, 'No relations were requested');

            return;
        }
        self::assertNotNull($entity->relations, 'Relations were delivered but not parsed');

        $known = RelationTypeId::getClassMap();
        $expected = [];
        foreach ($json['relations'] as $relation) {
            if (isset($known[$relation['type-id']])) {
                $expected[] = $relation;
            }
        }

        self::assertCount(count($expected), $entity->relations->relations, 'Relations of known types must not get lost');
        foreach ($expected as $index => $relationJson) {
            $relation = $entity->relations->relations[$index];
            $targetKey = str_replace('_', '-', $relationJson['target-type']);

            self::assertSame($relationJson['direction'], $relation->direction->value);
            self::assertSame($targetKey, $relation->targetType->path());
            self::assertSame($relationJson['type-id'], (string) $relation->type::getRelationTypeId());
            self::assertSame($relationJson['begin'] ?? null, null === $relation->begin ? null : (string) $relation->begin);
            self::assertSame($relationJson['end'] ?? null, null === $relation->end ? null : (string) $relation->end);
            self::assertSame($relationJson['ended'] ?? false, $relation->ended);
            self::assertSame($relationJson['ordering-key'] ?? null, $relation->orderingKey);
            self::assertSame($relationJson['source-credit'] ?? '', $relation->sourceCredit);
            self::assertSame($relationJson['target-credit'] ?? '', $relation->targetCredit);
            self::assertSame($relationJson['attributes'] ?? [], $relation->attributes);
            self::assertSame($relationJson['attribute-ids'] ?? [], $relation->attributeIds);
            self::assertSame($relationJson['attribute-values'] ?? [], $relation->attributeValues);
            self::assertSame($relationJson['attribute-credits'] ?? [], $relation->attributeCredits);

            EntityAssertions::assertMirrors($relation->target, $targetKey, $relationJson[EntityType::from($relationJson['target-type'])->value]);
        }
    }
}
