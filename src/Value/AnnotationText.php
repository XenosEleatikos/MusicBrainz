<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * An annotation text
 */
final readonly class AnnotationText implements Stringable
{
    /**
     * @param string $value The value
     */
    public function __construct(public string $value = '') {}

    public function __toString(): string
    {
        return $this->value;
    }
}
