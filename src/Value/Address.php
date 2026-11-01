<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * The address describes the location of the place using the standard addressing format for the country it is located in.
 *
 * @see https://musicbrainz.org/doc/Place
 */
final readonly class Address implements Stringable
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
