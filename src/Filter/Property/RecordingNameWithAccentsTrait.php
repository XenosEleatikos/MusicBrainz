<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait RecordingNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the recording (with accented characters).
     *
     * @return string
     */
    public static function recordingNameWithAccent(): string
    {
        return 'recordingaccent';
    }

    /**
     * Adds the name of the recording (with accented characters).
     *
     * @param Name $recordingNameWithAccents The name of the recording (with accented characters)
     *
     * @return static
     */
    public function addRecordingNameWithAccents(Name $recordingNameWithAccents): static
    {
        $this->addPhrase((string) $recordingNameWithAccents, self::recordingNameWithAccent());

        return $this;
    }
}
