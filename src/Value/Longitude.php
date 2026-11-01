<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

/**
 * Longitude
 */
final readonly class Longitude implements Stringable
{
    /**
     * @param float $value Degrees
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public float $value)
    {
        if (!($value >= -180.0 && $value <= 180.0)) {
            throw new InvalidArgumentException('A longitude is between -180 and 180 degrees, got ' . $value);
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
