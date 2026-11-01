<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function trim;

/**
 * ISWC
 */
final readonly class ISWC implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if ('' === trim($value)) {
            throw new InvalidArgumentException('ISWC must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
