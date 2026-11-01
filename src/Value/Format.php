<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * A medium format such as "CD" or "12" Vinyl", e.g. to search for releases of this format.
 */
final readonly class Format implements Stringable
{
    public function __construct(
        public string $name,
        public ?MBID $id = null,
    ) {}

    public function __toString(): string
    {
        return $this->name;
    }
}
