<?php

namespace MusicBrainz\Supplement\Field;

trait InstrumentRelationsTrait
{
    /**
     * True, if instrument relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $instrumentRelations = false;

    /**
     * Returns true, if instrument relations should be included, otherwise false.
     *
     * @return bool
     */
    public function getIncludeFlagForInstrumentRelations(): bool
    {
        return $this->instrumentRelations;
    }

    /**
     * Sets whether instrument relations should be included.
     *
     * @param bool $instrumentRelations True, if instrument relations should be included, otherwise false
     *
     * @return self
     */
    public function includeInstrumentRelations(bool $instrumentRelations = true): self
    {
        $this->instrumentRelations = $instrumentRelations;

        return $this;
    }
}
