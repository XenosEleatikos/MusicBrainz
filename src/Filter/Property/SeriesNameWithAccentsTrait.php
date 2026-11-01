<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

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
     * @return static
     */
    public function addSeriesNameWithAccents(Name $seriesName): static
    {
        $this->addPhrase((string) $seriesName, self::seriesNameWithAccents());

        return $this;
    }
}
