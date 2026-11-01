<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;

/**
 * An attribute of a work (e.g. its key or tempo)
 */
final readonly class Attribute implements Parsable
{
    public function __construct(
        public string $type,
        public ?MBID $typeId = null,
        public ?string $value = null,
        public ?MBID $valueId = null,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ArrayAccess::getString($data, 'type') ?? '',
            Json::id($data, 'type-id'),
            ArrayAccess::getString($data, 'value'),
            Json::id($data, 'value-id'),
        );
    }
}
