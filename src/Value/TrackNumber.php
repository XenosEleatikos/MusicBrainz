<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

/**
 * A track number
 */
final readonly class TrackNumber implements Stringable
{
    /**
     * @param int $value The number
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public int $value)
    {
        if (!($value >= 0)) {
            throw new InvalidArgumentException('A track number cannot be negative, got ' . $value);
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
