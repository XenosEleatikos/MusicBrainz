<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\SeriesTypeKind;

trait SeriesTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the series' type.
     *
     * @return string
     */
    public static function seriesType(): string
    {
        return 'type';
    }

    /**
     * Searches for the series' type.
     *
     * @param SeriesTypeKind $seriesType
     *
     * @return Phrase
     */
    public function addSeriesType(SeriesTypeKind $seriesType): Phrase
    {
        return $this->addPhrase($seriesType->value, self::seriesType());
    }
}
