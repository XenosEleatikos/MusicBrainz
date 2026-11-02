<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * A catalog number
 * This is a number assigned to the release by the label which can often be found on the spine or near the barcode.
 * There may be more than one, especially when multiple labels are involved. This is not the ASIN — there is a
 * relationship for that — nor the label code.
 *
 * @see https://musicbrainz.org/doc/Release#Catalog_number
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
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('CatalogNumber must not be empty');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
