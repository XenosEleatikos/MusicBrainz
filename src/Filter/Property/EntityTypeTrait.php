<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\EntityType;

trait EntityTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of entity.
     *
     * @return string
     */
    public static function entityType(): string
    {
        return 'type';
    }

    /**
     * Adds the type of entity.
     *
     * @param EntityType $entityType The type of entity
     *
     * @return static
     */
    public function addEntityType(EntityType $entityType): static
    {
        $this->addTerm($entityType->value, self::entityType());

        return $this;
    }
}
