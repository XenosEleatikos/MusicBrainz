<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Latitude;

trait LatitudeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the latitude.
     *
     * @return string
     *
     * @internal
     */
    public static function latitude(): string
    {
        return 'lat';
    }

    /**
     * Adds the latitude.
     *
     * @param Latitude $latitude The latitude
     *
     * @return static
     */
    public function addLatitude(Latitude $latitude): static
    {
        $this->addTerm((string) $latitude, self::latitude());

        return $this;
    }
}
