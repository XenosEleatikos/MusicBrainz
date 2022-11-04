<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Recording;

/**
 * Provides a getter for a recording.
 */
trait RecordingTrait
{
    /**
     * The recording
     *
     * @var Recording
     */
    public Recording $recording;

    /**
     * Returns the recording.
     *
     * @return Recording
     */
    public function getRecording(): Recording
    {
        return $this->recording;
    }

    /**
     * Sets the recording by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setRecordingFromArray(array $input): void
    {
        $this->recording = is_null($recording = ArrayAccess::getString($input, 'recording'))
            ? new Recording()
            : new Recording($recording);
    }
}
