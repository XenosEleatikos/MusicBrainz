<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Longitude;

trait LongitudeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the longitude.
     *
     * @return string
     *
     * @internal
     */
    public static function longitude(): string
    {
        return 'long';
    }

    /**
     * Adds the longitude.
     *
     * @param Longitude $longitude The longitude
     *
     * @return static
     */
    public function addLongitude(Longitude $longitude): static
    {
        $this->addTerm((string) $longitude, self::longitude());

        return $this;
    }
}
