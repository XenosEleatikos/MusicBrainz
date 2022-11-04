<?php

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\Barcode;

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
     * @return Term
     */
    public function addBarcode(Barcode $barcode): Term
    {
        return $this->addTerm($barcode, self::barcode());
    }
}
