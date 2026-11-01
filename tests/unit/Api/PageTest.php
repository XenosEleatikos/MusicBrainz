<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Test\Support\EntityFields;
use MusicBrainz\Test\Support\RecordedApi;
use MusicBrainz\Value\Page;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_filter;
use function array_keys;
use function count;
use function explode;
use function is_array;
use function str_starts_with;

use const ARRAY_FILTER_USE_KEY;

/**
 * Browse and search results of every recorded scenario: page metadata and every element must mirror the JSON.
 */
final class PageTest extends TestCase
{
    /**
     * @return array<string, array{string}>
     */
    public static function pages(): array
    {
        $names = array_keys(array_filter(
            RecordedApi::scenarios(),
            static fn(string $name): bool => str_starts_with($name, 'browse/') || str_starts_with($name, 'search/'),
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
        [$kind, $type] = explode('/', $scenario);

        self::assertInstanceOf(Page::class, $page);

        $listKey = array_values(array_filter(array_keys($json), static fn($key): bool => is_array($json[$key]) && array_is_list($json[$key])))[0];
        self::assertCount(count($json[$listKey]), $page);
        self::assertSame($json[$kind === 'search' ? 'count' : $type . '-count'], $page->getCount()->getNumber());
        self::assertSame($json[$kind === 'search' ? 'offset' : $type . '-offset'], $page->getOffset()->getNumber());

        foreach ($json[$listKey] as $index => $elementJson) {
            $element = $page[$index];
            if ('search' === $kind) {
                self::assertSame($elementJson['score'], $element->getScore()->getNumber());
                $element = $element->{'get' . str_replace(' ', '', ucwords(str_replace('-', ' ', $type)))}();
            }
            EntityFields::assertMirrors($element, $type, $elementJson);
            EntityFields::assertDetails($element, $elementJson);
            EntityFields::assertStructure($element, $elementJson);
        }

        self::assertSame([], $api->logged, 'The library logged problems');
    }
}
