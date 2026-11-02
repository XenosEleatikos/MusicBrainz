<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use BackedEnum;
use MusicBrainz\InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionEnum;
use ReflectionMethod;
use ReflectionNamedType;
use Throwable;

use function array_map;
use function basename;
use function glob;
use function str_starts_with;
use function substr;

use const PHP_INT_MAX;

/**
 * Whatever an application passes to a filter, it either becomes part of a valid query or is refused with a
 * MusicBrainz\InvalidArgumentException: nothing of the query builder or of PHP may leak out.
 */
final class FilterRobustnessTest extends TestCase
{
    private const HOSTILE_STRINGS = ['', ' ', "\u{00A0}", "\t\n", "\xC3\x28", 'two words', '"', '\\', 'AND', 'a:b', '(x)', '*', "tom's \"quote\" \\ back"];

    /**
     * @return iterable<string, array{class-string, string, mixed}>
     */
    public static function inputs(): iterable
    {
        foreach (glob(__DIR__ . '/../../../src/Filter/Search/*Filter.php') ?: [] as $file) {
            $class = 'MusicBrainz\\Filter\\Search\\' . basename($file, '.php');
            if ('MusicBrainz\\Filter\\Search\\AbstractFilter' === $class) {
                continue;
            }
            foreach ((new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                $parameter = str_starts_with($method->name, 'add') ? ($method->getParameters()[0] ?? null) : null;
                $type = $parameter?->getType();
                if (!$type instanceof ReflectionNamedType) {
                    continue;
                }
                $values = match (true) {
                    'string' === $type->getName() => self::HOSTILE_STRINGS,
                    'int' === $type->getName() => [-1, 0, 1, PHP_INT_MAX],
                    'bool' === $type->getName() => [true, false],
                    enum_exists($type->getName()) => array_map(static fn(BackedEnum $case): BackedEnum => $case, (new ReflectionEnum($type->getName()))->getName()::cases()),
                    default => [],
                };
                foreach ($values as $index => $value) {
                    yield substr($class, 25) . '::' . $method->name . '#' . $index => [$class, $method->name, $value];
                }
            }
        }
    }

    /**
     * @param class-string $class
     */
    #[DataProvider('inputs')]
    public function testInputIsAcceptedOrRefusedWithTheLibrariesException(string $class, string $method, mixed $value): void
    {
        $filter = new $class();

        try {
            $result = $filter->$method($value);
        } catch (InvalidArgumentException) {
            $this->expectNotToPerformAssertions();

            return;
        } catch (Throwable $throwable) {
            self::fail($class . '::' . $method . ' leaked ' . $throwable::class . ': ' . $throwable->getMessage());
        }

        self::assertSame($filter, $result);
        self::assertNotSame('', (string) $filter);
    }

    public function testCriteriaNarrowTheResultUnlessAnyIsRequested(): void
    {
        $filter = new \MusicBrainz\Filter\Search\ArtistFilter();
        $filter->addCountry(new \MusicBrainz\Filter\Value\Country('US'))->addEnded(false);

        self::assertSame('country:US AND ended:false', (string) $filter);
        self::assertSame('country:US OR ended:false', (string) $filter->matchAny());
    }
}
