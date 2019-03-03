<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Length;

/**
 * Provides a getter for the length.
 */
trait LengthTrait
{
    /**
     * A length
     *
     * @var Length
     */
    private $length;

    /**
     * Returns the length.
     *
     * @return Length
     */
    public function getLength(): Length
    {
        return $this->length;
    }

    /**
     * Sets the length by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setLengthFromArray(array $input): void
    {
        $this->length = is_null($length = ArrayAccess::getgetInteger($input, 'length'))
            ? new Length
            : new Length($length);
    }
}
