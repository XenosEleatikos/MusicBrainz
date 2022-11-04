<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\ISNI;
use MusicBrainz\Value\ISNIList;

/**
 * Provides a getter for a list of IPI codes.
 */
trait IsnisTrait
{
    /**
     * A list of ISNI codes
     *
     * @var ISNI|ISNIList
     */
    private ISNIList $isnis;

    /**
     * Returns a list of ISNI codes.
     *
     * @return ISNI|ISNIList
     */
    public function getIsnis(): ISNIList
    {
        return $this->isnis;
    }

    /**
     * Sets a list of ISNI codes by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setIsnisFromArray(array $input): void
    {
        $this->isnis = is_null($isnis = ArrayAccess::getArray($input, 'isnis'))
            ? new ISNIList()
            : new ISNIList($isnis);
    }
}
