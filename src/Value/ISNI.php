<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;
use function str_replace;

/**
 * An International Standard Name Identifier (ISNI): 16 characters, the last one may be an "X"
 *
 * @see https://musicbrainz.org/doc/ISNI
 */
final readonly class ISNI implements Stringable
{
    /** The 16 characters without spaces */
    public string $value;

    /**
     * @param string $value An ISNI, with or without the spaces it is usually printed with
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $value = '')
    {
        $normalized = str_replace(' ', '', $value);
        if ('' !== $normalized && 1 !== preg_match('/^[0-9]{15}[0-9X]$/', $normalized)) {
            throw new InvalidArgumentException('"' . $value . '" is not an ISNI (16 characters)');
        }
        $this->value = $normalized;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
