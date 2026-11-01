<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\ArtistTypeKind;

trait ArtistTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of artist.
     *
     * @return string
     */
    public static function artistType(): string
    {
        return 'type';
    }

    /**
     * Adds the type of artist.
     *
     * @param ArtistTypeKind $artistType The type of artist
     *
     * @return static
     */
    public function addArtistType(ArtistTypeKind $artistType): static
    {
        $this->addPhrase($artistType->value, self::artistType());

        return $this;
    }
}
