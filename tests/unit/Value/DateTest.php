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
        return ['full date' => ['1969-09-26', 'Y-m-d'], 'month' => ['1969-09', 'Y-m'], 'year' => ['1969', 'Y']];
    }

    #[DataProvider('validDates')]
    public function testKeepsThePrecisionOfPartialDates(string $input, string $format): void
    {
        $date = new Date($input);

        self::assertSame($format, $date->originalFormat);
        self::assertSame($input, (string) $date);
        self::assertSame($input, $date->dateTime->format($format));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidDates(): array
    {
        return ['empty' => [''], 'zero' => ['0'], 'unknown format' => ['26.09.1969'], 'month 13' => ['1969-13'], 'february 30' => ['1969-02-30']];
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
