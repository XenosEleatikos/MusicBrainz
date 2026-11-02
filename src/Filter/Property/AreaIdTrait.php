<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait AreaIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the area ID.
     *
     * @return string
     *
     * @internal
     */
    public static function areaId(): string
    {
        return 'aid';
    }

    /**
     * Adds the MusicBrainz Identifier (MBID) of an area.
     *
     * @param MBID $areaId The MusicBrainz Identifier (MBID) of an area
     *
     * @return static
     */
    public function addAreaId(MBID $areaId): static
    {
        $this->addTerm((string) $areaId, self::areaId());

        return $this;
    }
}
