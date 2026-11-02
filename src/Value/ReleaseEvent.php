<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\Json;

/**
 * The release of a release in an area at a date
 */
final readonly class ReleaseEvent implements Parsable
{
    public function __construct(
        public ?Date $date = null,
        public ?Area $area = null,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        $area = Json::object($data, 'area', Area::class);

        return new self(Json::date($data, 'date'), $area instanceof Area ? $area : null);
    }
}
