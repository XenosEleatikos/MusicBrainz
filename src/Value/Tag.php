<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use Stringable;

/**
 * A tag with the number of votes for it
 */
final readonly class Tag implements Parsable, Stringable
{
    public function __construct(
        public string $name,
        public int $count = 0,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(ArrayAccess::getString($data, 'name') ?? '', ArrayAccess::getInteger($data, 'count') ?? 0);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
