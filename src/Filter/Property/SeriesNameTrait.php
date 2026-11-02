<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait SeriesNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the series' name.
     *
     * @return string
     *
     * @internal
     */
    public static function seriesName(): string
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
    public function addSeriesName(Name $seriesName): static
    {
        $this->addPhrase((string) $seriesName, self::seriesName());

        return $this;
    }
}
