<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * Availability of cover art of a release at the Cover Art Archive
 */
final readonly class CoverArtArchive implements Parsable
{
    /**
     * @param bool $artwork  True, if there is any artwork
     * @param int  $count    Number of images
     * @param bool $front    True, if there is a front cover
     * @param bool $back     True, if there is a back cover
     * @param bool $darkened True, if the artwork is hidden because of a takedown
     */
    public function __construct(
        public bool $artwork = false,
        public int $count = 0,
        public bool $front = false,
        public bool $back = false,
        public bool $darkened = false,
    ) {}

    /**
     * @param array<mixed> $input The "cover-art-archive" object of a release
     */
    public static function fromArray(array $input): static
    {
        return new self(
            ArrayAccess::getBool($input, 'artwork') ?? false,
            ArrayAccess::getInteger($input, 'count') ?? 0,
            ArrayAccess::getBool($input, 'front') ?? false,
            ArrayAccess::getBool($input, 'back') ?? false,
            ArrayAccess::getBool($input, 'darkened') ?? false,
        );
    }
}
