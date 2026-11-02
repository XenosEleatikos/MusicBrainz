<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * A disambiguation
 *
 * @link https://musicbrainz.org/doc/Disambiguation_Comment
 */
final readonly class Disambiguation implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('Disambiguation must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
