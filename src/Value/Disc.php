<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;

/**
 * A disc ID of a medium
 */
final readonly class Disc implements Parsable
{
    /**
     * @param list<int> $offsets Sector offsets of the tracks
     */
    public function __construct(
        public string $id,
        public ?int $sectors = null,
        public array $offsets = [],
    ) {}

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ArrayAccess::getString($data, 'id') ?? '',
            ArrayAccess::getInteger($data, 'sectors'),
            Json::integers($data, 'offsets'),
        );
    }
}
