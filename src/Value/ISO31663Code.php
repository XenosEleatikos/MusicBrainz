<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * An ISO 3166-3 code
 *
 * @link https://en.wikipedia.org/wiki/ISO_3166-3
 */
final readonly class ISO31663Code implements Stringable
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
