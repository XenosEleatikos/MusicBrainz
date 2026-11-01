<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Address;

trait AddressTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the address.
     *
     * @return string
     */
    public static function address(): string
    {
        return 'address';
    }

    /**
     * Adds the address.
     *
     * @param Address $address The Address
     *
     * @return static
     */
    public function addAddress(Address $address): static
    {
        $this->addTerm((string) $address, self::address());

        return $this;
    }
}
