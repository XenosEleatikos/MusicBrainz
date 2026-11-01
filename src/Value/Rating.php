<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * The average rating of an entity (0 to 5 stars) and the number of votes
 */
final readonly class Rating implements Parsable
{
    public function __construct(
        public ?float $value,
        public int $votes = 0,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(ArrayAccess::getFloat($data, 'value'), ArrayAccess::getInteger($data, 'votes-count') ?? 0);
    }
}
