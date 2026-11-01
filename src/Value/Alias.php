<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use Stringable;

/**
 * An alias of an entity
 */
final readonly class Alias implements Parsable, Stringable
{
    public function __construct(
        public string $name,
        public ?string $sortName = null,
        public ?AliasType $type = null,
        public ?string $locale = null,
        public bool $primary = false,
        public ?Date $begin = null,
        public ?Date $end = null,
        public bool $ended = false,
    ) {}

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'sort-name'),
            AliasType::fromArray($data, 'type', 'type-id'),
            ArrayAccess::getString($data, 'locale'),
            ArrayAccess::getBool($data, 'primary') ?? false,
            // The search API calls the period begin-date/end-date, lookups call it begin/end
            Json::date($data, 'begin') ?? Json::date($data, 'begin-date'),
            Json::date($data, 'end') ?? Json::date($data, 'end-date'),
            ArrayAccess::getBool($data, 'ended') ?? false,
        );
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
