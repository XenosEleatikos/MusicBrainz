<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Value\DataQuality;

/**
 * Provides a getter for the data quality.
 */
trait DataQualityTrait
{
    /**
     * The data quality
     *
     * @var null|DataQuality
     */
    private ?DataQuality $quality;

    /**
     * Returns the data quality.
     *
     * @return null|DataQuality
     */
    public function getQuality(): ?DataQuality
    {
        return $this->quality;
    }

    /**
     * Sets the data quality by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setDataQualityFromArray(array $input): void
    {
        $value = ArrayAccess::getString($input, 'quality');
        $this->quality = null === $value ? null : DataQuality::tryFrom($value);

        if (null !== $value && null === $this->quality) {
            MusicBrainz::log()->error('Unexpected API behavior: "' . $value . '" is not a known DataQuality');
        }
    }
}
