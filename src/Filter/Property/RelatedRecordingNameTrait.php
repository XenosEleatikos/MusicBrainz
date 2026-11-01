<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

trait RelatedRecordingNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the title of a recording related to the work.
     *
     * @return string
     */
    public static function relatedRecordingName(): string
    {
        return 'recording';
    }

    /**
     * Searches for the title of a recording related to the work.
     *
     * @param Name $recordingName
     *
     * @return Phrase
     */
    public function addRelatedRecordingName(Name $recordingName): Phrase
    {
        return $this->addPhrase((string) $recordingName, self::relatedRecordingName());
    }
}
