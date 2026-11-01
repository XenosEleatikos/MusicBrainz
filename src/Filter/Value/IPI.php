<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function ctype_digit;
use function strlen;

/**
 * IPI
 */
final readonly class IPI implements Stringable
{
    /**
     * @param string $value An IPI code: 11 digits
     *
     * @throws InvalidArgumentException
     */
    public function __construct(public string $value)
    {
        if (11 !== strlen($value) || !ctype_digit($value)) {
            throw new InvalidArgumentException('"' . $value . '" is not an IPI code (11 digits)');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
