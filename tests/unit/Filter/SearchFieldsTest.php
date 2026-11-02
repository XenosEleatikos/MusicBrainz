<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

use function array_keys;
use function array_map;
use function class_uses;
use function file_get_contents;
use function json_decode;
use function sort;
use function str_replace;
use function ucwords;

/**
 * The search filter of every entity offers exactly the fields the documentation of the search lists
 * (https://musicbrainz.org/doc/MusicBrainz_API/Search#Search_Fields, copied to tests/Fixtures/search-fields.json).
 */
final class SearchFieldsTest extends TestCase
{
    /**
     * @return array<string, array{string, list<string>}>
     */
    public static function entities(): array
    {
        /** @var array<string, list<string>> $documented */
        $documented = json_decode((string) file_get_contents(__DIR__ . '/../../Fixtures/search-fields.json'), true);

        return array_combine(array_keys($documented), array_map(null, array_keys($documented), $documented));
    }

    /**
     * @param list<string> $documented
     */
    #[DataProvider('entities')]
    public function testFilterOffersExactlyTheDocumentedFields(string $entity, array $documented): void
    {
        $class = 'MusicBrainz\\Filter\\Search\\' . str_replace(' ', '', ucwords(str_replace('-', ' ', $entity))) . 'Filter';
        self::assertTrue(class_exists($class), "There is no search filter for $entity");

        $offered = [];
        foreach (class_uses($class) as $trait) {
            foreach ((new ReflectionClass($trait))->getMethods(ReflectionMethod::IS_STATIC | ReflectionMethod::IS_PUBLIC) as $method) {
                if (0 === $method->getNumberOfParameters() && 'string' === (string) $method->getReturnType()) {
                    $offered[] = (string) $method->invoke(null);
                }
            }
        }
        sort($offered);
        sort($documented);

        self::assertSame($documented, $offered, "Search fields of $entity (documented vs. offered by $class)");
    }
}
