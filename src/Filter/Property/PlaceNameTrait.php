<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait PlaceNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the place name.
     *
     * @return string
     */
    public static function placeName(): string
    {
        return 'place';
    }

    /**
     * Adds a place name.
     *
     * @param Name $placeName A place name
     *
     * @return Phrase
     */
    public function addPlaceName(Name $placeName): Phrase
    {
        return $this->addPhrase((string) $placeName, self::placeName());
    }
}
