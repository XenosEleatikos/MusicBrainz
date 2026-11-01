<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * An Amazon Standard Identification Number (ASIN)
 *
 * @link https://musicbrainz.org/doc/ASIN
 */
final readonly class ASIN implements Stringable
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
