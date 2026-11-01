<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait RecordingNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the recording (without accented characters).
     *
     * @return string
     */
    public static function recordingNameWithoutAccent(): string
    {
        return 'recording';
    }

    /**
     * Adds the name of the recording (without accented characters).
     *
     * @param Name $recordingNameWithoutAccents The name of the name of the recording (without accented characters)
     *
     * @return static
     */
    public function addRecordingNameWithoutAccents(Name $recordingNameWithoutAccents): static
    {
        $this->addPhrase((string) $recordingNameWithoutAccents, self::recordingNameWithoutAccent());

        return $this;
    }
}
