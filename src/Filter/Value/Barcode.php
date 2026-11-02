<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * Barcodes are numbers used as stock control mechanisms by retailers: as such they are highly standardised and well
 * recognised, and form an invaluable identifier for communication between companies. On physical releases, they usually
 * appear in the form of a machine-readable series of black and white bars, hence the name "barcode".
 *
 * @see https://musicbrainz.org/doc/Barcode
 */
final readonly class Barcode implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('Barcode must not be empty');
        }
        if (1 === preg_match('/\s/u', $value)) {
            throw new InvalidArgumentException('Barcode must not contain whitespace');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
