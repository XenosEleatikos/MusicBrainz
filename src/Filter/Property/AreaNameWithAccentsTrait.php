<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait AreaNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the area's name.
     *
     * @return string
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
     * @return Phrase
     */
    public function addAreaNameWithAccents(Name $areaName): Phrase
    {
        return $this->addPhrase((string) $areaName, self::areaNameWithAccents());
    }
}
