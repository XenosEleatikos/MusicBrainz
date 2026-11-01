<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

/**
 * MediumNumber
 */
final readonly class MediumNumber implements Stringable
{
    /**
     * @param int $value The number
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public int $value)
    {
        if (!($value >= 1)) {
            throw new InvalidArgumentException('A medium number starts at 1, got ' . $value);
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
