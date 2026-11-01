<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * ISO3166Code
 */
final readonly class ISO3166Code implements Stringable
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
