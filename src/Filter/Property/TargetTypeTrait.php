<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\EntityType;

trait TargetTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of an entity type related to the URL.
     *
     * @return string
     */
    public static function targetType(): string
    {
        return 'targettype';
    }

    /**
     * Searches for an entity type related to the URL (e.g. "artist").
     *
     * @param EntityType $targetType
     *
     * @return static
     */
    public function addTargetType(EntityType $targetType): static
    {
        $this->addTerm($targetType->value, self::targetType());

        return $this;
    }
}
