<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\MusicBrainz;

/**
 * A search result of an annotation: the annotated entity and the text
 */
final readonly class Annotation implements Parsable
{
    public function __construct(
        public ?MBID $entityId,
        public string $name,
        public string $text,
        public ?EntityType $entityType = null,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        $typeName = ArrayAccess::getString($data, 'type');
        $entityType = null === $typeName ? null : EntityType::tryFrom(str_replace('-', '_', $typeName));
        if (null !== $typeName && null === $entityType) {
            MusicBrainz::log()->error('Unknown entity type "' . $typeName . '" of an annotation');
        }

        return new self(
            Json::id($data, 'entity'),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'text') ?? '',
            $entityType,
        );
    }
}
