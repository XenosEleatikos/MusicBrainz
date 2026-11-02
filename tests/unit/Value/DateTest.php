<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Config;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Test\Support\FakeHttpClient;
use MusicBrainz\Value\Date;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

use function sprintf;

final class DateTest extends TestCase
{
    /** @var list<string> */
    private array $logged = [];

    protected function setUp(): void
    {
        $this->logged = [];
        $logger = new class ($this->logged) extends AbstractLogger {
            /** @param list<string> $messages */
            public function __construct(private array &$messages) {}

            public function log($level, string|Stringable $message, array $context = []): void
            {
                $this->messages[] = "[$level] $message";
            }
        };
        new MusicBrainz(new FakeHttpClient(), new Psr17Factory(), $logger, new Config());
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function validDates(): array
    {
        return [
            'full date' => ['1969-09-26', 'Y-m-d'], 'month' => ['1969-09', 'Y-m'], 'year' => ['1969', 'Y'], 'unknown month' => ['1988-??-01', 'Y-??-d'],
        ];
    }

    #[DataProvider('validDates')]
    public function testKeepsThePrecisionOfPartialDates(string $input, string $format): void
    {
        $date = new Date($input);

        self::assertSame($format, $date->originalFormat);
        self::assertSame($input, (string) $date);
        self::assertSame($input, $date->dateTime?->format($format));
    }

    /**
     * @return array<string, array{string, string, ?int, ?int, ?int}>
     */
    public static function datesWithUnknownParts(): array
    {
        return [
            'unknown year' => ['????-05-23', '????-m-d', null, 5, 23], 'unknown year, month only' => ['????-05', '????-m', null, 5, null],
            'only the day' => ['????-??-17', '????-??-d', null, null, 17], 'unknown month' => ['1988-??-01', 'Y-??-d', 1988, null, 1],
            'leap day without a year' => ['????-02-29', '????-m-d', null, 2, 29], 'day 31 without a month' => ['1988-??-31', 'Y-??-d', 1988, null, 31],
        ];
    }

    #[DataProvider('datesWithUnknownParts')]
    public function testKnowsWhichPartsAreUnknown(string $input, string $format, ?int $year, ?int $month, ?int $day): void
    {
        $date = new Date($input);

        self::assertSame($format, $date->originalFormat);
        self::assertSame([$year, $month, $day], [$date->year, $date->month, $date->day]);
        self::assertSame($input, (string) $date);
        self::assertSame(null === $year, null === $date->dateTime);
        if (null !== $year) {
            self::assertSame(sprintf('%04d-01-%02d', $year, $day), $date->dateTime->format('Y-m-d'));
        }
    }

    public function testYearsBeforeTheCommonEra(): void
    {
        $date = new Date('-070');

        self::assertSame('Y', $date->originalFormat);
        self::assertSame(-70, $date->year);
        self::assertSame(-70, (int) $date->dateTime?->format('Y'));
        self::assertSame('-070', (string) $date);
        self::assertSame(-200, (new Date('-200-05-17'))->year);
        self::assertSame(17, (new Date('-200-05-17'))->day);
    }

    public function testKnownPartsGiveYearMonthAndDay(): void
    {
        $date = new Date('1969-09-26');

        self::assertSame([1969, 9, 26], [$date->year, $date->month, $date->day]);
        self::assertSame('1969-09-01', (new Date('1969-09'))->dateTime?->format('Y-m-d'));
        self::assertSame([1969, null, null], [(new Date('1969'))->year, (new Date('1969'))->month, (new Date('1969'))->day]);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidDates(): array
    {
        return ['empty' => [''], 'zero' => ['0'], 'unknown format' => ['26.09.1969'], 'month 13' => ['1969-13'], 'february 30' => ['1969-02-30'], 'unknown month without day' => ['1969-??'], 'nothing known' => ['????'], 'minus without digits' => ['-'], 'two digits after the minus' => ['-07'], 'plus sign' => ['+1969'], 'nothing known, with month placeholder' => ['????-??'], 'only unknown parts' => ['????-??-??'], 'unknown month at the end' => ['1969-??-??'], 'unknown month, day 32' => ['1969-??-32'], 'feb 30 without a year' => ['????-02-30'], 'april 31 without a year' => ['????-04-31']];
    }

    #[DataProvider('invalidDates')]
    public function testRefusesAnythingThatIsNoDate(string $input): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Date($input);
    }

    #[DataProvider('invalidDates')]
    public function testAResponseWithAnUnexpectedDateIsReportedNotFatal(string $input): void
    {
        self::assertNull(Date::tryFrom($input));
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('is not a', $this->logged[0]);
    }
}
