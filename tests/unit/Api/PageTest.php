<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Test\Support\EntityAssertions;
use MusicBrainz\Test\Support\RecordedApi;
use MusicBrainz\Value\Page;
use MusicBrainz\Value\SearchResult;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_filter;
use function array_is_list;
use function array_keys;
use function array_map;
use function count;
use function in_array;
use function is_array;
use function str_starts_with;

use const ARRAY_FILTER_USE_KEY;

/**
 * Browse and search results of every recorded scenario: page metadata and every element must mirror the JSON.
 */
final class PageTest extends TestCase
{
    /** Collections that are deliberately empty: the web service does not let the API add areas or instruments */
    private const EMPTY = ['auth/browse/area/by-collection', 'auth/browse/instrument/by-collection'];

    /**
     * @return array<string, array{string}>
     */
    public static function pages(): array
    {
        $names = array_keys(array_filter(
            RecordedApi::scenarios(),
            static fn(string $name): bool => str_starts_with($name, 'browse/') || str_starts_with($name, 'search/') || str_starts_with($name, 'auth/browse/'),
            ARRAY_FILTER_USE_KEY,
        ));

        return array_combine($names, array_map(static fn(string $name): array => [$name], $names));
    }

    #[DataProvider('pages')]
    public function testPageMirrorsJson(string $scenario): void
    {
        $api = new RecordedApi();
        $page = RecordedApi::scenarios()[$scenario]($api->musicBrainz);
        $json = $api->lastResponse();
        [$kind, $type] = RecordedApi::parse($scenario);

        self::assertInstanceOf(Page::class, $page);

        $listKey = array_values(array_filter(array_keys($json), static fn($key): bool => is_array($json[$key]) && array_is_list($json[$key])))[0];
        self::assertCount(count($json[$listKey]), $page);
        if (!in_array($scenario, self::EMPTY, true)) {
            self::assertGreaterThan(0, count($page), 'A scenario that finds nothing tests nothing');
        }
        self::assertSame($json[$kind === 'search' ? 'count' : $type . '-count'], $page->totalCount);
        self::assertSame($json[$kind === 'search' ? 'offset' : $type . '-offset'], $page->offset);
        self::assertSame($json['created'] ?? null, $page->created);

        foreach ($json[$listKey] as $index => $elementJson) {
            $element = $page[$index];
            if ('search' === $kind) {
                self::assertInstanceOf(SearchResult::class, $element);
                self::assertSame($elementJson['score'], $element->score);
                $element = $element->entity;
            }
            EntityAssertions::assertMirrors($element, $type, $elementJson, "{$type}[{$index}]");
        }

        self::assertSame([], $api->logged, 'The library logged problems');
    }
}
