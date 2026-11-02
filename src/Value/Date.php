<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use DateTimeImmutable;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\MusicBrainz;
use Stringable;

use function in_array;
use function preg_match;

/**
 * A date as MusicBrainz knows it: a year, a year and a month, or a full date. The precision is kept. Parts may be unknown,
 * which MusicBrainz writes as question marks.
 *
 * Supported are "YYYY", "YYYY-MM", "YYYY-MM-DD" (years before the common era have a minus sign and at least three digits,
 * as in "-070") and the forms with unknown parts: "YYYY-??-DD" (day known, month unknown),
 * "????-MM" and "????-MM-DD" (year unknown) and "????-??-DD" (only the day is known). Anything else, and impossible
 * dates such as "2017-02-30", are refused.
 */
final readonly class Date implements Stringable
{
    /**
     * The format of the given date: "Y", "Y-m", "Y-m-d", or with unknown parts "Y-??-d", "????-m", "????-m-d" and
     * "????-??-d".
     */
    public string $originalFormat;

    /** The year, null if it is unknown; negative before the common era */
    public ?int $year;

    /** The month, null if it is unknown or not given */
    public ?int $month;

    /** The day, null if it is unknown or not given */
    public ?int $day;

    /**
     * The first moment of the period the date names, or null if the year is unknown.
     *
     * This is necessary to interpret the date time correctly: it always points to an exact point of time, and will be
     * 2017-01-01 at 00:00 if constructed by "2017", which means "sometime in 2017". If the month is unknown
     * ("2017-??-05") it is January.
     */
    public ?DateTimeImmutable $dateTime;

    /**
     * @param string $value A date in one of the supported formats
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public string $value)
    {
        if (1 !== preg_match('/^(-[0-9]{3,}|[0-9]{4}|\?{4})(?:-([0-9]{2}|\?\?)(?:-([0-9]{2}))?)?$/', $value, $match)) {
            throw new InvalidArgumentException('"' . $value . '" is not a date (YYYY, YYYY-MM or YYYY-MM-DD, parts may be unknown: ?)');
        }
        $year = '????' === $match[1] ? null : (int) $match[1];
        $monthGiven = isset($match[2]);
        $month = !$monthGiven || '??' === $match[2] ? null : (int) $match[2];
        $day = isset($match[3]) ? (int) $match[3] : null;

        // "????" and "????-??" tell nothing; an unknown month needs a day, as it would be a plain year otherwise
        if (null === $year && null === $month && null === $day) {
            throw new InvalidArgumentException('"' . $value . '" is not a date: nothing of it is known');
        }
        if ($monthGiven && null === $month && null === $day) {
            throw new InvalidArgumentException('"' . $value . '" is not a date: an unknown month needs a known day');
        }
        if (null !== $month && ($month < 1 || $month > 12)) {
            throw new InvalidArgumentException('"' . $value . '" is not a possible date');
        }
        if (null !== $day) {
            // Without a year a leap year is assumed, without a month the longest month
            $longest = null === $month ? 31 : self::daysInMonth($month, $year ?? 2000);
            if ($day < 1 || $day > $longest) {
                throw new InvalidArgumentException('"' . $value . '" is not a possible date');
            }
        }

        $this->originalFormat = (null === $year ? '????' : 'Y')
            . ($monthGiven ? '-' . (null === $month ? '??' : 'm') : '')
            . (null !== $day ? '-d' : '');
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->dateTime = null === $year ? null : (new DateTimeImmutable('2000-01-01 00:00:00'))->setDate($year, $month ?? 1, $day ?? 1);
    }

    private static function daysInMonth(int $month, int $year): int
    {
        if (2 === $month) {
            return (0 === $year % 4 && 0 !== $year % 100) || 0 === $year % 400 ? 29 : 28;
        }

        return in_array($month, [4, 6, 9, 11], true) ? 30 : 31;
    }

    /**
     * Reads a date of a response of the web service. A value that is no date is reported to the logger and gives null,
     * so that one unexpected value does not spoil the whole response.
     *
     * @internal
     */
    public static function tryFrom(string $value): ?self
    {
        try {
            return new self($value);
        } catch (InvalidArgumentException $exception) {
            MusicBrainz::log()->warning('Unexpected API behavior: ' . $exception->getMessage());

            return null;
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
