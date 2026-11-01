<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function trim;

/**
 * CatalogNumber
 */
final readonly class CatalogNumber implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if ('' === trim($value)) {
            throw new InvalidArgumentException('CatalogNumber must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
