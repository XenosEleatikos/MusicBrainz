<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\ASIN;

trait AsinTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the ASIN.
     *
     * @return string
     */
    public static function asin(): string
    {
        return 'asin';
    }

    /**
     * Adds the Amazon Standard Identification Number (ASIN).
     *
     * @param ASIN $asin The Amazon Standard Identification Number (ASIN)
     *
     * @return static
     */
    public function addASIN(ASIN $asin): static
    {
        $this->addTerm((string) $asin, self::asin());

        return $this;
    }
}
