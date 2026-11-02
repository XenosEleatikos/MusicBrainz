<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\ApiException;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Test\Support\RecordedApi;
use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use MusicBrainz\ResponseException;
use MusicBrainz\Test\Support\FakeHttpClient;
use MusicBrainz\Value\MBID;
use MusicBrainz\Supplement\Lookup\ArtistFields;
use Nyholm\Psr7\Factory\Psr17Factory;
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

        self::assertInstanceOf(ApiException::class, $exception);
        self::assertSame(404, $exception->getCode());
        self::assertSame('MusicBrainz API error: Not Found', $exception->getMessage());
    }

    public function testSearchWithoutAnyCriterionIsRefusedBeforeARequestIsMade(): void
    {
        $api = new RecordedApi();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('at least one argument');

        try {
            $api->musicBrainz->api()->search()->artist(new ArtistFilter(), new PageFilter());
        } finally {
            self::assertSame([], $api->http->requests);
        }
    }

    public function testAnAnswerThatIsNoEntityIsAResponseError(): void
    {
        $http = new FakeHttpClient();
        $http->queueJson('[1,2]');
        $musicBrainz = new MusicBrainz($http, new Psr17Factory(), null, (new Config())->setMinRequestInterval(0.0)->setUserAgent('Tests/1 ( https://example.org )'));

        $this->expectException(ResponseException::class);

        $musicBrainz->api()->lookup()->artist(new MBID('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d'), new ArtistFields());
    }
}
