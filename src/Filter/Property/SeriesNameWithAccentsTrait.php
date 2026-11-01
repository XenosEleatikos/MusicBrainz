<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait SeriesNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the series' name.
     *
     * @return string
     */
    public static function seriesNameWithAccents(): string
    {
        return 'seriesaccent';
    }

    /**
     * Searches for the series' name (with the specified diacritics).
     *
     * @param Name $seriesName
     *
     * @return Phrase
     */
    public function addSeriesNameWithAccents(Name $seriesName): Phrase
    {
        return $this->addPhrase((string) $seriesName, self::seriesNameWithAccents());
    }
}
