<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait PlaceNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the place name.
     *
     * @return string
     *
     * @internal
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
     * @return static
     */
    public function addPlaceName(Name $placeName): static
    {
        $this->addPhrase((string) $placeName, self::placeName());

        return $this;
    }
}
