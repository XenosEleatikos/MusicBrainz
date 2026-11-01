<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * The credit of an artist on a release, release group, recording or track
 */
final readonly class ArtistCredit implements Parsable
{
    public function __construct(
        public Artist $artist,
        public string $name = '',
        public string $joinPhrase = '',
    ) {}

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Artist::fromArray(ArrayAccess::getArray($data, 'artist') ?? []),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'joinphrase') ?? '',
        );
    }
}
