<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Work;

use function is_null;

/**
 * Provides a getter for a work.
 */
trait WorkTrait
{
    /**
     * The work number
     *
     * @var Work
     */
    public Work $work;

    /**
     * Returns the work.
     *
     * @return Work
     */
    public function getWork(): Work
    {
        return $this->work;
    }

    /**
     * Sets the work by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setWorkFromArray(array $input, ?string $key = 'work'): void
    {
        if (is_null($key)) {
            $this->work = new Work($input);

            return;
        }

        $this->work = is_null($work = ArrayAccess::getArray($input, $key))
            ? new Work()
            : new Work($work);
    }
}
