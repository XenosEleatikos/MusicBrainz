<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use Stringable;

/**
 * A genre, as assigned to an entity (with the number of votes for it)
 */
final readonly class Genre implements Parsable, Stringable
{
    public function __construct(
        public ?MBID $id,
        public string $name,
        public int $count = 0,
        public string $disambiguation = '',
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getInteger($data, 'count') ?? 0,
            ArrayAccess::getString($data, 'disambiguation') ?? '',
        );
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
