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
     * @param Name $artistName The name of the artist (without accented characters)
     *
     * @return static
     */
    public function addArtistName(Name $artistName): static
    {
        $this->addPhrase((string) $artistName, self::artistName());

        return $this;
    }
}
