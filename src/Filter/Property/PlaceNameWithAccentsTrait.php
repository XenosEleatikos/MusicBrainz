<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait PlaceNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the place's name (with the specified diacritics).
     *
     * @return string
     *
     * @internal
     */
    public static function placeNameWithAccents(): string
    {
        return 'placeaccent';
    }

    /**
     * Searches for the place's name (with the specified diacritics).
     *
     * @param Name $placeName
     *
     * @return static
     */
    public function addPlaceNameWithAccents(Name $placeName): static
    {
        $this->addPhrase((string) $placeName, self::placeNameWithAccents());

        return $this;
    }
}
