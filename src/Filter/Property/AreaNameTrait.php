<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait AreaNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the area name.
     *
     * @return string
     */
    public static function areaName(): string
    {
        return 'area';
    }

    /**
     * Adds an area name.
     *
     * @param Name $areaName An area name
     *
     * @return static
     */
    public function addAreaName(Name $areaName): static
    {
        $this->addPhrase((string) $areaName, self::areaName());

        return $this;
    }
}
