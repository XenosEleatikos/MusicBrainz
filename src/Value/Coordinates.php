<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * Geographical coordinates in decimal degrees
 */
final readonly class Coordinates
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): ?self
    {
        $latitude = ArrayAccess::getFloat($data, 'latitude');
        $longitude = ArrayAccess::getFloat($data, 'longitude');

        return null === $latitude || null === $longitude ? null : new self($latitude, $longitude);
    }
}
