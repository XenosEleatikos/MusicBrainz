<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * An annotation text
 */
final readonly class AnnotationText implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('AnnotationText must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
