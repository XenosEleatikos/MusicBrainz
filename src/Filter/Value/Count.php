<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

/**
 * Count
 */
final readonly class Count implements Stringable
{
    /**
     * @param int $value The number
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public int $value)
    {
        if (!($value >= 0)) {
            throw new InvalidArgumentException('A count cannot be negative, got ' . $value);
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
