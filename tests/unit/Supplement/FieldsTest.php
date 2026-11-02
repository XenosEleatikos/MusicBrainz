<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Supplement;

use MusicBrainz\Supplement\Browse\ReleaseFields as BrowseReleaseFields;
use MusicBrainz\Supplement\Fields;
use MusicBrainz\Supplement\Lookup\ArtistFields;
use MusicBrainz\Supplement\Lookup\ReleaseFields;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function array_filter;
use function array_keys;
use function array_map;
use function array_unique;
use function array_values;
use function explode;
use function file_get_contents;
use function get_class_methods;
use function json_decode;
use function sort;
use function str_starts_with;
use function substr;

/**
 * The include flags of the Lookup and Browse fields classes must be exactly those the web service accepts for the entity.
 * The accepted parameters were asked from the live web service (bin/probe-includes) and are stored in
 * tests/Fixtures/accepted-includes.json.
 */
final class FieldsTest extends TestCase
{
    /**
     * @return array<string, array{string, string, list<string>}>
     */
    public static function entities(): array
    {
        /** @var array<string, array<string, array<string, bool>>> $accepted */
        $accepted = json_decode((string) file_get_contents(__DIR__ . '/../../Fixtures/accepted-includes.json'), true);
        $cases = [];
        foreach ($accepted as $kind => $entities) {
            foreach ($entities as $entity => $includes) {
                $cases["$kind/$entity"] = [$kind, $entity, array_keys(array_filter($includes))];
            }
        }

        return $cases;
    }

    /**
     * @param list<string> $accepted
     */
    #[DataProvider('entities')]
    public function testFlagsAreExactlyTheAcceptedOnes(string $kind, string $entity, array $accepted): void
    {
        $class = 'MusicBrainz\\Supplement\\' . ucfirst($kind) . '\\' . str_replace(' ', '', ucwords(str_replace('-', ' ', $entity))) . 'Fields';
        $flags = self::flags($class);
        $own = array_values(array_filter($flags, static fn(string $flag): bool => !str_starts_with($flag, 'user-')));
        $user = array_values(array_filter($flags, static fn(string $flag): bool => str_starts_with($flag, 'user-')));
        sort($accepted);
        sort($own);

        self::assertSame($accepted, $own, "$class offers other include parameters than the web service accepts");
        foreach ($user as $flag) {
            self::assertContains(substr($flag, 5), $accepted, "$flag is offered, but the web service does not accept the parameter without the user- prefix");
        }
    }

    /**
     * @param class-string<Fields> $class
     *
     * @return list<string>
     */
    private static function flags(string $class): array
    {
        $flags = [];
        foreach (get_class_methods($class) as $method) {
            if (str_starts_with($method, 'include')) {
                $fields = new $class();
                $fields->$method();
                // A flag that needs another parameter brings it along: the flag itself is the first one
                $flags[] = explode('+', (string) $fields)[0];
            }
        }

        return array_values(array_unique(array_map(static fn(string $flag): string => $flag, $flags)));
    }

    public function testAParameterThatNeedsAnotherOneBringsItAlong(): void
    {
        self::assertSame('media+releases', (string) (new ArtistFields())->includeMedia());
        self::assertSame('releases+media', (string) (new ArtistFields())->includeReleases()->includeMedia());
        self::assertSame('isrcs+recordings', (string) (new ReleaseFields())->includeIsrcs());
        self::assertSame('isrcs+recordings', (string) (new BrowseReleaseFields())->includeIsrcs());
        self::assertSame('tags', (string) (new ArtistFields())->includeTags());
    }
}
