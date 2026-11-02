<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ArtistNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the artist's name (without accented characters).
     *
     * @return string
     *
     * @internal
     */
    public static function artistName(): string
    {
        return 'artist';
    }

    /**
     * Adds the artist's name (without accented characters).
     *
     * @param Name $artistNameWithoutAccents The name of the artist's name (without accented characters)
     *
     * @return static
     */
    public function addArtistName(Name $artistNameWithoutAccents): static
    {
        $this->addPhrase((string) $artistNameWithoutAccents, self::artistName());

        return $this;
    }
}
