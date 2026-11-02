<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use Stringable;

/**
 * A collection of entities of an editor
 */
final readonly class Collection implements Parsable, Stringable
{
    public function __construct(
        public ?MBID $id,
        public string $name,
        public string $editor,
        public ?EntityType $entityType = null,
        public ?CollectionType $type = null,
        public int $count = 0,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        $entityTypeName = ArrayAccess::getString($data, 'entity-type');
        $entityType = null === $entityTypeName ? null : EntityType::tryFrom(str_replace('-', '_', $entityTypeName));
        if (null !== $entityTypeName && null === $entityType) {
            \MusicBrainz\MusicBrainz::log()->error('Unknown entity type "' . $entityTypeName . '" of a collection');
        }

        return new self(
            Json::id($data),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'editor') ?? '',
            $entityType,
            CollectionType::fromKeys($data, 'type', 'type-id'),
            null === $entityTypeName ? 0 : (ArrayAccess::getInteger($data, $entityTypeName . '-count') ?? ArrayAccess::getInteger($data, str_replace('_', '-', $entityTypeName) . '-count') ?? ArrayAccess::getInteger($data, str_replace('-', '_', $entityTypeName) . '-count') ?? 0),
        );
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
