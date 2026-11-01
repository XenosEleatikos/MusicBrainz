<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * A CD stub: a disc ID submitted for a CD that is not in the database yet
 */
final readonly class CdStub implements Parsable
{
    public function __construct(
        public string $discId,
        public string $title,
        public string $artist,
        public string $barcode = '',
        public string $disambiguation = '',
        public ?int $trackCount = null,
    ) {}

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ArrayAccess::getString($data, 'id') ?? '',
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'artist') ?? '',
            ArrayAccess::getString($data, 'barcode') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            ArrayAccess::getInteger($data, 'count'),
        );
    }
}
