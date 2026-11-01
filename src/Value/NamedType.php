<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use BackedEnum;
use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\MusicBrainz;
use Stringable;

use function strcasecmp;

/**
 * Base class for types that MusicBrainz editors maintain in the database (artist types, release statuses...).
 *
 * New values can appear at any time. Therefore the raw name and the MusicBrainz Identifier of the type are always
 * kept. The enum of known values is just a convenience, see {@see NamedType::kind()}.
 */
abstract readonly class NamedType implements Stringable
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
    abstract public function kind(): ?BackedEnum;

    /**
     * Finds the enum case for the name. The web service is not consistent in letter case between its endpoints
     * (e.g. "Female" in lookups, "female" in searches), so the name is matched case-insensitively as fallback.
     */
    final protected function resolveKind(): ?BackedEnum
    {
        $enum = static::kindEnum();

        $exact = $enum::tryFrom($this->name);
        if (null !== $exact) {
            return $exact;
        }

        foreach ($enum::cases() as $case) {
            if (0 === strcasecmp((string) $case->value, $this->name)) {
                return $case;
            }
        }

        return null;
    }

    /**
     * Creates the type from API data. Logs a warning if the value is not known to this library.
     */
    final public static function make(string $name, ?string $id = null): static
    {
        $type = new static($name, self::mbid($id));

        if (null === $type->kind()) {
            MusicBrainz::log()->warning(
                'Unknown ' . static::class . ' "' . $name . '"' . (null === $id ? '' : ' (id ' . $id . ')')
                . ': not yet known to this library'
            );
        }

        return $type;
    }

    private static function mbid(?string $id): ?MBID
    {
        if (null === $id || '' === $id) {
            return null;
        }

        try {
            return new MBID($id);
        } catch (InvalidArgumentException) {
            MusicBrainz::log()->error('Unexpected API behavior: "' . $id . '" is not an MBID');

            return null;
        }
    }

    /**
     * Creates the type from an API response array. Returns null if the name is missing.
     *
     * @param array<mixed> $data
     */
    final public static function fromArray(array $data, string $nameKey, string $idKey): ?static
    {
        $name = ArrayAccess::getString($data, $nameKey);

        return null === $name ? null : static::make($name, ArrayAccess::getString($data, $idKey));
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
