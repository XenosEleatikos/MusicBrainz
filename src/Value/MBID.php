<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;
use function strtolower;

/**
 * A MusicBrainz Identifier (MBID)
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_Identifier
 */
final readonly class MBID implements Stringable
{
    /** The identifier in the form 8-4-4-4-12 hexadecimal digits, in lower case */
    public string $value;

    /**
     * @param string $value A MusicBrainz Identifier (MBID)
     *
     * @throws InvalidArgumentException if the value is not an MBID
     */
    public function __construct(string $value)
    {
        if (1 !== preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){3}-[a-f\d]{12}\z/i', $value)) {
            throw new InvalidArgumentException('"' . $value . '" is not a valid MusicBrainz Identifier (MBID)');
        }

        $this->value = strtolower($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
