<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

/**
 * Latitude
 */
final readonly class Latitude implements Stringable
{
    /**
     * @param float $value Degrees
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public float $value)
    {
        if (!($value >= -90.0 && $value <= 90.0)) {
            throw new InvalidArgumentException('A latitude is between -90 and 90 degrees, got ' . $value);
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
