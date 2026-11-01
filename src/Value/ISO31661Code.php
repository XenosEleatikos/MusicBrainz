<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * An ISO 3166-1 code
 *
 * @link https://en.wikipedia.org/wiki/ISO_3166-1
 */
final readonly class ISO31661Code implements Stringable
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
