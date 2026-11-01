<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ArtistNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the artist's name (without accented characters).
     *
     * @return string
     */
    public static function artistNameWithoutAccent(): string
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
    public function addArtistNameWithoutAccents(Name $artistNameWithoutAccents): static
    {
        $this->addPhrase((string) $artistNameWithoutAccents, self::artistNameWithoutAccent());

        return $this;
    }
}
