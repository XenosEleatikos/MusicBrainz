<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use BackedEnum;
use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Value;

/**
 * Base class for types that MusicBrainz editors maintain in the database (artist types, release statuses...).
 *
 * New values can appear at any time. Therefore the raw name and the MusicBrainz Identifier of the type are always
 * kept. The enum of known values is just a convenience, see {@see NamedType::kind()}.
 */
abstract readonly class NamedType implements Value
{
    final public function __construct(
        public string $name,
        public ?MBID $id = null,
    ) {}

    /**
     * Returns the enum containing the known values of this type.
     *
     * @return class-string<BackedEnum>
     */
    abstract protected static function kindEnum(): string;

    /**
     * Returns the known value as enum case, or null if this value is not (yet) known to this library.
     */
    public function kind(): ?BackedEnum
    {
        return static::kindEnum()::tryFrom($this->name);
    }

    /**
     * Creates the type from API data. Logs a warning if the value is not known to this library.
     */
    final public static function make(string $name, ?string $id = null): static
    {
        $type = new static($name, null === $id ? null : new MBID($id));

        if (null === $type->kind()) {
            MusicBrainz::log()->warning(
                'Unknown ' . static::class . ' "' . $name . '"' . (null === $id ? '' : ' (id ' . $id . ')')
                . ': not yet known to this library'
            );
        }

        return $type;
    }

    /**
     * Creates the type from an API response array. Returns null if the name is missing.
     *
     * @param array<mixed> $input
     */
    final public static function fromArray(array $input, string $nameKey, string $idKey): ?static
    {
        $name = ArrayAccess::getString($input, $nameKey);

        return null === $name ? null : static::make($name, ArrayAccess::getString($input, $idKey));
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
