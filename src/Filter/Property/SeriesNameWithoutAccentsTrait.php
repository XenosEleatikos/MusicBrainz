<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait SeriesNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the series' name.
     *
     * @return string
     */
    public static function seriesNameWithoutAccents(): string
    {
        return 'series';
    }

    /**
     * Searches for the series' name (diacritics are ignored).
     *
     * @param Name $seriesName
     *
     * @return static
     */
    public function addSeriesNameWithoutAccents(Name $seriesName): static
    {
        $this->addPhrase((string) $seriesName, self::seriesNameWithoutAccents());

        return $this;
    }
}
