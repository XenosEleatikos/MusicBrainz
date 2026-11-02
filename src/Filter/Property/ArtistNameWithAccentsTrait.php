<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ArtistNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the artist's name (with accented characters).
     *
     * @return string
     *
     * @internal
     */
    public static function artistNameWithAccents(): string
    {
        return 'artistaccent';
    }

    /**
     * Adds the artist's name (with accented characters).
     *
     * @param Name $artistNameWithAccents The name of the artist's name (with accented characters)
     *
     * @return static
     */
    public function addArtistNameWithAccents(Name $artistNameWithAccents): static
    {
        $this->addPhrase((string) $artistNameWithAccents, self::artistNameWithAccents());

        return $this;
    }
}
