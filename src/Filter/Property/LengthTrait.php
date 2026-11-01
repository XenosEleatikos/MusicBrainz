<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Length;

trait LengthTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the length.
     *
     * @return string
     */
    public static function length(): string
    {
        return 'dur';
    }

    /**
     * Adds the length.
     *
     * @param Length $length The Length
     *
     * @return static
     */
    public function addLength(Length $length): static
    {
        $this->addTerm((string) $length, self::length());

        return $this;
    }
}
