<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\DataQuality;

trait DataQualityTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the data quality.
     *
     * @return string
     */
    public static function dataQuality(): string
    {
        return 'quality';
    }

    /**
     * Adds the data quality.
     *
     * @param DataQuality $dataQuality The data quality
     *
     * @return static
     */
    public function addDataQuality(DataQuality $dataQuality): static
    {
        $this->addTerm($dataQuality->value, self::dataQuality());

        return $this;
    }
}
