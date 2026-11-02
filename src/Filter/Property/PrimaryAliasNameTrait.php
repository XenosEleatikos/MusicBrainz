<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait PrimaryAliasNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of any primary alias attached to the artist.
     *
     * @return string
     *
     * @internal
     */
    public static function primaryAliasName(): string
    {
        return 'primary_alias';
    }

    /**
     * Searches for any primary alias attached to the artist (diacritics are ignored).
     *
     * @param Name $aliasName
     *
     * @return static
     */
    public function addPrimaryAliasName(Name $aliasName): static
    {
        $this->addPhrase((string) $aliasName, self::primaryAliasName());

        return $this;
    }
}
