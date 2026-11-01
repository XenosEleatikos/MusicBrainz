<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * A disambiguation
 *
 * @link https://musicbrainz.org/doc/Disambiguation_Comment
 */
final readonly class Disambiguation implements Stringable
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
