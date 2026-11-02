<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;
use function strtoupper;

/**
 * A country
 *
 * @link https://wiki.musicbrainz.org/Release_Country
 */
final readonly class Country implements Stringable
{
    public string $value;

    /**
     * @param string $value A two-letter country code (ISO 3166-1 alpha-2); stored in upper case
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if (1 !== preg_match('/^[A-Za-z]{2}$/', $value)) {
            throw new InvalidArgumentException('"' . $value . '" is not a two-letter country code');
        }
        $this->value = strtoupper($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
