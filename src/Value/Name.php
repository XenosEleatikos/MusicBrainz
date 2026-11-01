<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * A name
 *
 * - The official name of the artist, be it a person or a band
 * - The name of a label
 * - The name of an alias
 * - The name of an area
 * - The name of a tag
 */
final readonly class Name implements Stringable
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
