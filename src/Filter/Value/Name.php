<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * A name
 *
 * - The official name of the artist, be it a person or a band
 * - The name of a label
 * - The name of an alias
 * - The name of an area
 * - The name of a tag
 */
final readonly class Name implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('Name must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
