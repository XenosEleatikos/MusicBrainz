<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
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
     * @return Term
     */
    public function addSeriesId(MBID $seriesId): Term
    {
        return $this->addTerm((string) $seriesId, self::seriesId());
    }
}
