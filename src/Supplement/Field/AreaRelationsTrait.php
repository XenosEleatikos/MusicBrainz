<?php

namespace MusicBrainz\Supplement\Field;

trait AreaRelationsTrait
{
    /**
     * True, if area relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $areaRelations = false;

    /**
     * Returns true, if area relations should be included, otherwise false.
     *
     * @return bool
     */
    public function getIncludeFlagForAreaRelations(): bool
    {
        return $this->areaRelations;
    }

    /**
     * Sets whether area relations should be included.
     *
     * @param bool $areaRelations True, if area relations should be included, otherwise false
     *
     * @return self
     */
    public function includeAreaRelations(bool $areaRelations = true): self
    {
        $this->areaRelations = $areaRelations;

        return $this;
    }
}
