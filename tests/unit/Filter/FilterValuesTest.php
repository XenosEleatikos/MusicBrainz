<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use MusicBrainz\InvalidArgumentException;
use MusicBrainz\Filter\Value\Count;
use MusicBrainz\Filter\Value\Country;
use MusicBrainz\Filter\Value\IPI;
use MusicBrainz\Filter\Value\LabelCode;
use MusicBrainz\Filter\Value\Latitude;
use MusicBrainz\Filter\Value\Length;
use MusicBrainz\Filter\Value\Longitude;
use MusicBrainz\Filter\Value\MediumNumber;
use MusicBrainz\Filter\Value\Name;
use MusicBrainz\Filter\Value\TrackNumber;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * The small value objects that the search filters take as input: immutable, and they refuse values that cannot be right
 * instead of turning them into something empty.
 */
final class FilterValuesTest extends TestCase
{
    public function testTextValuesKeepTheirValue(): void
    {
        self::assertSame('Tom Waits', (string) new Name('Tom Waits'));
        self::assertSame('Tom Waits', (new Name('Tom Waits'))->value);
    }

    public function testTextValuesMustNotBeEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name(' ');
    }

    public function testCountsAndNumbersMustNotBeNegative(): void
    {
        self::assertSame('3', (string) new Count(3));
        self::assertSame('0', (string) new Count(0));
        self::assertSame('12345', (string) new Length(12345));
        self::assertSame('2', (string) new MediumNumber(2));
        self::assertSame('7', (string) new TrackNumber(7));

        $this->expectException(InvalidArgumentException::class);
        new Count(-1);
    }

    public function testMediumNumbersStartAtOne(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new MediumNumber(0);
    }

    public function testCoordinatesStayWithinTheEarth(): void
    {
        self::assertSame('51.3397', (string) new Latitude(51.3397));
        self::assertSame('-180', (string) new Longitude(-180.0));

        $this->expectException(InvalidArgumentException::class);
        new Latitude(90.5);
    }

    public function testLongitudeRange(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Longitude(180.1);
    }

    public function testCountryCodesAreUpperCased(): void
    {
        self::assertSame('GB', (string) new Country('gb'));

        $this->expectException(InvalidArgumentException::class);
        new Country('GBR');
    }

    public function testIpiCodesHaveElevenDigits(): void
    {
        self::assertSame('00014107338', (string) new IPI('00014107338'));

        $this->expectException(InvalidArgumentException::class);
        new IPI('1410733');
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function labelCodes(): array
    {
        return [
            'with prefix' => ['LC-01234', 'LC-01234'], 'lower case, space' => ['lc 1234', 'LC-01234'], 'only digits' => ['299', 'LC-00299'],
        ];
    }

    #[DataProvider('labelCodes')]
    public function testLabelCodesAreNormalized(string $input, string $expected): void
    {
        $code = new LabelCode($input);

        self::assertSame($expected, (string) $code);
        self::assertSame(substr($expected, 3), $code->withoutPrefix());
    }

    public function testInvalidLabelCodesAreRefused(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LabelCode('LC-123456');
    }
}
