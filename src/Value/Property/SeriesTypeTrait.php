<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\SeriesType;

/**
 * Provides a getter for a series type.
 */
trait SeriesTypeTrait
{
    private ?SeriesType $seriesType;

    /**
     * Returns a series type, or null if the web service did not deliver one.
     */
    public function getSeriesType(): ?SeriesType
    {
        return $this->seriesType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setSeriesTypeFromArray(array $input): void
    {
        $this->seriesType = SeriesType::fromArray($input, 'type', 'type-id');
    }
}
