<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

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
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('ISWC must not be empty');
        }
        if (1 === preg_match('/\s/u', $value)) {
            throw new InvalidArgumentException('ISWC must not contain whitespace');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
