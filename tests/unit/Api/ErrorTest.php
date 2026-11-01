<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Exception;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Test\Support\RecordedApi;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_filter;
use function array_keys;
use function str_starts_with;

use const ARRAY_FILTER_USE_KEY;

/**
 * Error responses of the web service, recorded for real requests, are turned into exceptions.
 */
final class ErrorTest extends TestCase
{
    /**
     * @return array<string, array{string}>
     */
    public static function errors(): array
    {
        $names = array_keys(array_filter(RecordedApi::scenarios(), static fn(string $name): bool => str_starts_with($name, 'error/'), ARRAY_FILTER_USE_KEY));

        return array_combine($names, array_map(static fn(string $name): array => [$name], $names));
    }

    #[DataProvider('errors')]
    public function testNotFoundIsReportedWithStatusAndMessage(string $scenario): void
    {
        $api = new RecordedApi();

        $exception = RecordedApi::scenarios()[$scenario]($api->musicBrainz);

        self::assertInstanceOf(Exception::class, $exception);
        self::assertSame(404, $exception->getCode());
        self::assertSame('MusicBrainz API error: Not Found', $exception->getMessage());
    }

    public function testSearchWithoutAnyCriterionIsRefusedBeforeARequestIsMade(): void
    {
        $api = new RecordedApi();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('at least one argument');

        try {
            $api->musicBrainz->api()->search()->artist(new ArtistFilter(), new PageFilter());
        } finally {
            self::assertSame([], $api->http->requests);
        }
    }
}
