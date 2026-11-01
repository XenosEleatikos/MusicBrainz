<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\PlaceType;

/**
 * Provides a getter for a place type.
 */
trait PlaceTypeTrait
{
    private ?PlaceType $placeType;

    /**
     * Returns a place type, or null if the web service did not deliver one.
     */
    public function getPlaceType(): ?PlaceType
    {
        return $this->placeType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setPlaceTypeFromArray(array $input): void
    {
        $this->placeType = PlaceType::fromArray($input, 'type', 'type-id');
    }
}
