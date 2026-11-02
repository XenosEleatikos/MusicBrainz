<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Test\Support\EntityAssertions;
use MusicBrainz\Test\Support\RecordedApi;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_filter;
use function array_keys;
use function array_map;
use function str_starts_with;

use const ARRAY_FILTER_USE_KEY;

/**
 * Lookups of every recorded entity (minimal, with all includes, with user data): the value object must mirror every
 * key of the JSON.
 */
final class LookupTest extends TestCase
{
    /**
     * @return array<string, array{string}>
     */
    public static function lookups(): array
    {
        $names = array_keys(array_filter(
            RecordedApi::scenarios(),
            static fn(string $name): bool => str_starts_with($name, 'lookup/') || str_starts_with($name, 'auth/lookup/'),
            ARRAY_FILTER_USE_KEY,
        ));

        return array_combine($names, array_map(static fn(string $name): array => [$name], $names));
    }

    #[DataProvider('lookups')]
    public function testValueMirrorsJson(string $scenario): void
    {
        $api = new RecordedApi();
        $entity = RecordedApi::scenarios()[$scenario]($api->musicBrainz);
        [, $type] = RecordedApi::parse($scenario);

        EntityAssertions::assertMirrors($entity, $type, $api->lastResponse());

        self::assertSame([], $api->logged, 'The library logged problems');
    }
}
