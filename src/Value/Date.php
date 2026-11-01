<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use DateTimeImmutable;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\MusicBrainz;
use Stringable;

use function preg_match;

/**
 * A date as MusicBrainz knows it: a year, a year and a month, or a full date. The precision is kept.
 *
 * Supported formats are "YYYY", "YYYY-MM" and "YYYY-MM-DD". Anything else, and impossible dates such as "2017-02-30",
 * are refused.
 */
final readonly class Date implements Stringable
{
    /**
     * The format of the given date ("Y", "Y-m" or "Y-m-d").
     *
     * This is necessary to interpret the date time correctly: it always points to an exact point of time, and will be
     * 2017-01-01 at 00:00 if constructed by "2017", which means "sometime in 2017".
     */
    public string $originalFormat;

    /** The first moment of the period the date names */
    public DateTimeImmutable $dateTime;

    /**
     * @param string $value A date in one of the supported formats
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public string $value)
    {
        $format = match (true) {
            1 === preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $value) => 'Y-m-d',
            1 === preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])$/', $value) => 'Y-m',
            1 === preg_match('/^[0-9]{4}$/', $value) => 'Y',
            default => throw new InvalidArgumentException('"' . $value . '" is not a date (YYYY, YYYY-MM or YYYY-MM-DD)'),
        };
        $dateTime = DateTimeImmutable::createFromFormat('!' . $format, $value);
        if (false === $dateTime || $dateTime->format($format) !== $value) {
            throw new InvalidArgumentException('"' . $value . '" is not a possible date');
        }

        $this->originalFormat = $format;
        $this->dateTime = $dateTime;
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
