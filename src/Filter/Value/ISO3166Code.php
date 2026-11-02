<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * ISO3166Code
 */
final readonly class ISO3166Code implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('ISO3166Code must not be empty');
        }
        if (1 === preg_match('/\s/u', $value)) {
            throw new InvalidArgumentException('ISO3166Code must not contain whitespace');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
