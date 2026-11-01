<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait PlaceNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the place's name.
     *
     * @return string
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
     * @return Phrase
     */
    public function addPlaceNameWithAccents(Name $placeName): Phrase
    {
        return $this->addPhrase((string) $placeName, self::placeNameWithAccents());
    }
}
