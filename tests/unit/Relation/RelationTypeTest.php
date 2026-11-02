<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Relation;

use MusicBrainz\Definition\RelationTypeId;
use MusicBrainz\Relation\Type;
use MusicBrainz\Value\EntityType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_count_values;
use function array_filter;
use function array_keys;
use function array_map;
use function array_values;
use function class_exists;
use function preg_match;

/**
 * The map of relationship type UUIDs to classes.
 */
final class RelationTypeTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function relationTypes(): array
    {
        $map = RelationTypeId::getClassMap();

        return array_combine(array_keys($map), array_map(null, array_keys($map), array_values($map)));
    }

    #[DataProvider('relationTypes')]
    public function testEveryEntryIsAUsableRelationType(string $uuid, string $class): void
    {
        self::assertSame(1, preg_match('/^[0-9a-f]{8}(-[0-9a-f]{4}){3}-[0-9a-f]{12}$/', $uuid), 'The key must be a UUID');
        self::assertTrue(class_exists($class), "$class does not exist");

        $type = new $class();

        self::assertInstanceOf(Type::class, $type);
        self::assertSame($uuid, (string) $class::getRelationTypeId(), 'getRelationTypeId() must return the key of the map');
        self::assertNotSame('', (string) $class::getRelationName());
        self::assertInstanceOf(EntityType::class, $class::getBaseEntityType());
        self::assertInstanceOf(EntityType::class, $class::getRelatedEntityType());
    }

    public function testEveryClassIsMappedOnlyOnce(): void
    {
        $duplicates = array_filter(array_count_values(RelationTypeId::getClassMap()), static fn(int $count): bool => $count > 1);

        self::assertSame([], $duplicates);
    }
}
