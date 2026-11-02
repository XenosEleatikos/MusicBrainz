<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait RecordingIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the MusicBrainz ID (MBID) of a recording.
     *
     * @return string
     *
     * @internal
     */
    public static function recordingId(): string
    {
        return 'rid';
    }

    /**
     * Adds the MusicBrainz ID (MBID) of a recording.
     *
     * @param MBID $recordingId The MusicBrainz ID (MBID) of a recording
     *
     * @return static
     */
    public function addRecordingId(MBID $recordingId): static
    {
        $this->addTerm((string) $recordingId, self::recordingId());

        return $this;
    }
}
