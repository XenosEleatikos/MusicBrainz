<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Country;

trait CountryTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the country.
     *
     * @return string
     *
     * @internal
     */
    public static function country(): string
    {
        return 'country';
    }

    /**
     * Adds a country.
     *
     * @param Country $country A country
     *
     * @return static
     */
    public function addCountry(Country $country): static
    {
        $this->addTerm((string) $country, self::country());

        return $this;
    }
}
