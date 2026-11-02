<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;

/**
 * The period of existence of an entity
 */
final readonly class LifeSpan implements Parsable
{
    public function __construct(
        public ?Date $begin = null,
        public ?Date $end = null,
        public bool $ended = false,
    ) {}

    /**
     * @param array<mixed> $data A "life-span" object
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::date($data, 'begin'),
            Json::date($data, 'end'),
            ArrayAccess::getBool($data, 'ended') ?? false,
        );
    }
}
