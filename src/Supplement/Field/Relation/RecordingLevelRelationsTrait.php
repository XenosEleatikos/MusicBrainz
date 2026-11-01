<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait RecordingLevelRelationsTrait
{
    /**
     * True, if recording level relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $recordingLevelRelations = false;

    /**
     * Sets whether recording level relations should be included.
     *
     * @param bool $recordingLevelRelations True, if recording level relations should be included, otherwise false
     *
     * @return self
     */
    public function includeRecordingLevelRelations(bool $recordingLevelRelations = true): self
    {
        $this->recordingLevelRelations = $recordingLevelRelations;

        return $this;
    }
}
