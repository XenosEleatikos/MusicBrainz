<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * The address describes the location of the place using the standard addressing format for the country it is located in.
 *
 * @see https://musicbrainz.org/doc/Place
 */
final readonly class Address implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('Address must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
