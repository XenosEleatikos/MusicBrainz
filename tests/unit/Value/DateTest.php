<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Value\Date;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DateTest extends TestCase
{
    /**
     * @return array<string, array{string, ?string, bool}>
     */
    public static function dates(): array
    {
        return [
            'full date'      => ['1969-09-26', 'Y-m-d', true],
            'month'          => ['1969-09', 'Y-m', true],
            'year'           => ['1969', 'Y', true],
            'empty'          => ['', null, false],
            'unknown format' => ['26.09.1969', null, false],
            'month 13'       => ['1969-13', null, false],
            'february 30'    => ['1969-02-30', 'Y-m-d', false],
        ];
    }

    #[DataProvider('dates')]
    public function testKeepsThePrecisionOfPartialDates(string $input, ?string $format, bool $valid): void
    {
        $date = new Date($input);

        self::assertSame($format, $date->originalFormat);
        self::assertSame($valid ? $input : '', (string) $date);
        self::assertSame($valid ? $input : null, $date->dateTime?->format($format ?? 'Y'));
    }
}
