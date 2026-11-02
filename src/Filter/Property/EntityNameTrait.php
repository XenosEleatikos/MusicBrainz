<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait EntityNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the entity name.
     *
     * @return string
     *
     * @internal
     */
    public static function entityName(): string
    {
        return 'name';
    }

    /**
     * Adds an entity name.
     *
     * @param Name $entityName An entity name
     *
     * @return static
     */
    public function addEntityName(Name $entityName): static
    {
        $this->addPhrase((string) $entityName, self::entityName());

        return $this;
    }
}
