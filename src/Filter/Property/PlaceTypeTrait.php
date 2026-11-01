<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\PlaceTypeKind;

trait PlaceTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of place.
     *
     * @return string
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
     * @return Phrase
     */
    public function addPlaceType(PlaceTypeKind $placeType): Phrase
    {
        return $this->addPhrase($placeType->value, self::placeType());
    }
}
