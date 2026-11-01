<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Barcode;

trait BarcodeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the barcode.
     *
     * @return string
     */
    public static function barcode(): string
    {
        return 'barcode';
    }

    /**
     * Adds the barcode.
     *
     * @param Barcode $barcode The Barcode
     *
     * @return static
     */
    public function addBarcode(Barcode $barcode): static
    {
        $this->addTerm((string) $barcode, self::barcode());

        return $this;
    }
}
