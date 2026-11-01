<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Value\EntityType;

/**
 * Provides a getter for the entity type.
 */
trait EntityTypeTrait
{
    /**
     * The type is used to state whether an entity is a person, a group, or something else.
     *
     * @var null|EntityType
     */
    private ?EntityType $entityType;

    /**
     * Returns the entity type.
     *
     * @return null|EntityType
     */
    public function getEntityType(): ?EntityType
    {
        return $this->entityType;
    }

    /**
     * Sets the entity type by extracting it from a given input array.
     *
     * @param array  $input An array returned by the webservice
     * @param string $key   An array key. Default: 'entity-type'
     *
     * @return void
     */
    private function setEntityTypeFromArray(array $input, string $key = 'entity-type'): void
    {
        $value = ArrayAccess::getString($input, $key);
        $this->entityType = null === $value ? null : EntityType::tryFrom($value);

        if (null !== $value && null === $this->entityType) {
            MusicBrainz::log()->error('Unexpected API behavior: "' . $value . '" is not a known EntityType');
        }
    }
}
