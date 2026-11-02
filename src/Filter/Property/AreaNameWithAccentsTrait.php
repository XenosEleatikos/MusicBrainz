<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait AreaNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the area's name.
     *
     * @return string
     *
     * @internal
     */
    public static function areaNameWithAccents(): string
    {
        return 'areaaccent';
    }

    /**
     * Searches for the area's name (with the specified diacritics).
     *
     * @param Name $areaName
     *
     * @return static
     */
    public function addAreaNameWithAccents(Name $areaName): static
    {
        $this->addPhrase((string) $areaName, self::areaNameWithAccents());

        return $this;
    }
}
