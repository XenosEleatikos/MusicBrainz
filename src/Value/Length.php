<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

/**
 * A length
 */
final readonly class Length implements Stringable
{
    /**
     * @param int $milliseconds The length in milliseconds
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public int $milliseconds)
    {
        if (!($milliseconds >= 0)) {
            throw new InvalidArgumentException('A length cannot be negative, got ' . $milliseconds);
        }
    }

    public function __toString(): string
    {
        return (string) $this->milliseconds;
    }
}
