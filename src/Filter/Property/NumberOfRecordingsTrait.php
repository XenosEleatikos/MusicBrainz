<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Count;

trait NumberOfRecordingsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the number of recordings related to the work.
     *
     * @return string
     */
    public static function numberOfRecordings(): string
    {
        return 'recording_count';
    }

    /**
     * Searches for the number of recordings related to the work.
     *
     * @param Count $count
     *
     * @return static
     */
    public function addNumberOfRecordings(Count $count): static
    {
        $this->addTerm((string) $count, self::numberOfRecordings());

        return $this;
    }
}
