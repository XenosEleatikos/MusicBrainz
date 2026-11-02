<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\PlaceTypeKind;

trait PlaceTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of place.
     *
     * @return string
     *
     * @internal
     */
    public static function placeType(): string
    {
        return 'type';
    }

    /**
     * Adds the type of place.
     *
     * @param PlaceTypeKind $placeType The type of place
     *
     * @return static
     */
    public function addPlaceType(PlaceTypeKind $placeType): static
    {
        $this->addPhrase($placeType->value, self::placeType());

        return $this;
    }
}
