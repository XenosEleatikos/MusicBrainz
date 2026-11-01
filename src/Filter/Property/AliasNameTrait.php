<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait AliasNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the alias name.
     *
     * @return string
     */
    public static function aliasName(): string
    {
        return 'alias';
    }

    /**
     * Adds an alias.
     *
     * @param Name $aliasName An alias name
     *
     * @return static
     */
    public function addAliasName(Name $aliasName): static
    {
        $this->addPhrase((string) $aliasName, self::aliasName());

        return $this;
    }
}
