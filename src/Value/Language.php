<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * A language
 */
final readonly class Language implements Stringable
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
