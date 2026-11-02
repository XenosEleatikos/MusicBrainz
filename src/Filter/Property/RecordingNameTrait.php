<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait RecordingNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the recording (without accented characters).
     *
     * @return string
     *
     * @internal
     */
    public static function recordingName(): string
    {
        return 'recording';
    }

    /**
     * Adds the name of the recording (without accented characters).
     *
     * @param Name $recordingName The name of the recording (without accented characters)
     *
     * @return static
     */
    public function addRecordingName(Name $recordingName): static
    {
        $this->addPhrase((string) $recordingName, self::recordingName());

        return $this;
    }
}
