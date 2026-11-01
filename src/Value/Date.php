<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use DateTimeImmutable;
use Stringable;

use function preg_match;

/**
 * A date as MusicBrainz knows it: a year, a year and a month, or a full date. The precision is kept.
 *
 * Supported formats are "YYYY", "YYYY-MM" and "YYYY-MM-DD". A string in another format, or an impossible date such as
 * "2017-02-30", results in a date without a value (empty string, `$dateTime` is null).
 */
final readonly class Date implements Stringable
{
    /**
     * The format of the given date ("Y", "Y-m" or "Y-m-d"), null if there was none or it was not recognized.
     *
     * This is necessary to interpret the date time correctly: it always points to an exact point of time, and will be
     * 2017-01-01 at 00:00 if constructed by "2017", which means "sometime in 2017".
     */
    public ?string $originalFormat;

    /** The first moment of the period the date names, null if the date has no value */
    public ?DateTimeImmutable $dateTime;

    /**
     * @param string $date A date in one of the supported formats, or an empty string
     */
    public function __construct(string $date = '')
    {
        $format = self::format($date);
        $dateTime = null === $format ? false : DateTimeImmutable::createFromFormat('!' . $format, $date);

        $this->originalFormat = $format;
        $this->dateTime = false !== $dateTime && $dateTime->format($format) === $date ? $dateTime : null;
    }

    public function __toString(): string
    {
        return null !== $this->dateTime && null !== $this->originalFormat ? $this->dateTime->format($this->originalFormat) : '';
    }

    private static function format(string $date): ?string
    {
        return match (true) {
            1 === preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date) => 'Y-m-d',
            1 === preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])$/', $date) => 'Y-m',
            1 === preg_match('/^[0-9]{4}$/', $date) => 'Y',
            default => null,
        };
    }
}
