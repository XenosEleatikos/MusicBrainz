<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

/**
 * An International Standard Musical Work Code (ISWC)
 * The International Standard Musical Work Code (ISWC) is an ISO standard similar to ISBNs for identifying musical
 * works/compositions.
 *
 * @link https://musicbrainz.org/doc/ISWC
 */
final readonly class ISWC implements Stringable
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
