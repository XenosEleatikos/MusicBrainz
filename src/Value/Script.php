<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * A script
 */
final readonly class Script implements Stringable
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
