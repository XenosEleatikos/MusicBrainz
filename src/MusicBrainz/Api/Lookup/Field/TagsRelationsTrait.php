<?php

namespace MusicBrainz\Api\Lookup\Field;

trait TagsRelationsTrait
{
    /**
     * True, if tags relations should be included, otherwise false
     *
     * @var bool
     */
    private $tagsRelations = false;

    /**
     * Returns true, if tags relations should be included, otherwise false.
     *
     * @return bool
     */
    public function isTagsRelations(): bool
    {
        return $this->tagsRelations;
    }

    /**
     * Sets whether tags relations should be included.
     *
     * @param bool $tagsRelations True, if tags relations should be included, otherwise false
     *
     * @return self
     */
    public function setTagsRelations(bool $tagsRelations = true): self
    {
        $this->tagsRelations = $tagsRelations;

        return $this;
    }
}
