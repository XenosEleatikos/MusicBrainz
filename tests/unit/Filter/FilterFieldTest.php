<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use LogicException;
use MusicBrainz\Value\DataQuality;
use MusicBrainz\Value\Date;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\MBID;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionUnionType;

use function basename;
use function enum_exists;
use function glob;
use function lcfirst;
use function method_exists;
use function str_starts_with;
use function substr;

/**
 * Every add method of every search filter, whatever type its parameter has, adds a criterion for the field its name
 * promises: addTrackDisplayNumber() must search the field "number" and no other one.
 */
final class FilterFieldTest extends TestCase
{
    /**
     * Add methods whose name differs from the static method that names the field.
     */
    private const FIELD_METHODS = [
        'addUrl' => 'urlString',
        'addFormat' => 'format',
    ];

    /**
     * @return iterable<string, array{class-string, string, string}>
     */
    public static function addMethods(): iterable
    {
        foreach (glob(__DIR__ . '/../../../src/Filter/Search/*Filter.php') ?: [] as $file) {
            $class = 'MusicBrainz\\Filter\\Search\\' . basename($file, '.php');
            if ('MusicBrainz\\Filter\\Search\\AbstractFilter' === $class) {
                continue;
            }
            foreach ((new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->isStatic() || !str_starts_with($method->name, 'add')) {
                    continue;
                }
                $fieldMethod = self::FIELD_METHODS[$method->name] ?? lcfirst(substr($method->name, 3));
                yield substr($class, 25) . '::' . $method->name => [$class, $method->name, $fieldMethod];
            }
        }
    }

    /**
     * @param class-string $class
     */
    #[DataProvider('addMethods')]
    public function testAddMethodSearchesTheFieldItsNamePromises(string $class, string $method, string $fieldMethod): void
    {
        self::assertTrue(method_exists($class, $fieldMethod), $class . ' has no field name method ' . $fieldMethod . '()');

        $filter = new $class();
        $type = (new ReflectionMethod($class, $method))->getParameters()[0]->getType();
        $types = $type instanceof ReflectionUnionType ? $type->getTypes() : [$type];
        $results = [];
        foreach ($types as $namedType) {
            self::assertInstanceOf(ReflectionNamedType::class, $namedType);
            $filter = new $class();
            $filter->$method(self::sample($namedType->getName()));
            $results[] = (string) $filter;
        }

        foreach ($results as $query) {
            self::assertStringStartsWith($class::$fieldMethod() . ':', $query);
        }
    }

    private static function sample(string $type): mixed
    {
        $case = static fn(string $enum): mixed => $enum::cases()[0];

        return match (true) {
            'string' === $type => 'sample',
            'int' === $type => 1,
            'bool' === $type => true,
            MBID::class === $type => new MBID('c3aeb863-7b26-4388-94e8-5a240f2be21b'),
            Date::class === $type => new Date('2020-01-22'),
            DataQuality::class === $type, EntityType::class === $type => $case($type),
            enum_exists($type) => $case($type),
            str_starts_with($type, 'MusicBrainz\\Filter\\Value\\') => self::filterValue(substr($type, 25)),
            default => throw new LogicException('Add a sample for ' . $type),
        };
    }

    private static function filterValue(string $name): object
    {
        $class = 'MusicBrainz\\Filter\\Value\\' . $name;
        $argument = match ($name) {
            'Count', 'Length', 'MediumNumber', 'TrackNumber' => 1,
            'Latitude', 'Longitude' => 1.5,
            'Country' => 'DE',
            'IPI' => '00014107338',
            'ISNI' => '0000000121032683',
            'LabelCode' => '1234',
            default => 'sample',
        };

        return new $class($argument);
    }
}
