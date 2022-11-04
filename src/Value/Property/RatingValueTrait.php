<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\RatingValue;

/**
 * Provides a getter for the rating value.
 */
trait RatingValueTrait
{
    /**
     * The rating value
     *
     * @var RatingValue
     */
    private $ratingValue;

    /**
     * Returns the rating value.
     *
     * @return RatingValue
     */
    public function getRatingValue(): RatingValue
    {
        return $this->ratingValue;
    }

    /**
     * Sets the rating value by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setRatingValueFromArray(array $input): void
    {
        $this->ratingValue = is_null($ratingValue = ArrayAccess::getFloat($input, 'value'))
            ? new RatingValue()
            : new RatingValue($ratingValue);
    }
}
