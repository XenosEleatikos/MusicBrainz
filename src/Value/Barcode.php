<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use Stringable;

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
     */
    public function __construct(public string $value = '') {}

    public function __toString(): string
    {
        return $this->value;
    }
}
