<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Length;

trait QuantizedLengthTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the quantized length (length / 2000).
     *
     * @return string
     */
    public static function quantizedLength(): string
    {
        return 'qdur';
    }

    /**
     * Adds the quantized length (length / 2000).
     *
     * @param Length $quantizedLength The Quantized length (length / 2000)
     *
     * @return static
     */
    public function addQuantizedLength(Length $quantizedLength): static
    {
        $this->addTerm((string) $quantizedLength, self::quantizedLength());

        return $this;
    }
}
