<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait SeriesIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the series' MBID.
     *
     * @return string
     */
    public static function seriesId(): string
    {
        return 'sid';
    }

    /**
     * Searches for the series' MBID.
     *
     * @param MBID $seriesId
     *
     * @return static
     */
    public function addSeriesId(MBID $seriesId): static
    {
        $this->addTerm((string) $seriesId, self::seriesId());

        return $this;
    }
}
