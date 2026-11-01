<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * A title
 */
final readonly class Title implements Stringable
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
