<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait LabelRelationsTrait
{
    /**
     * True, if label relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $labelRelations = false;

    /**
     * Sets whether label relations should be included.
     *
     * @param bool $labelRelations True, if label relations should be included, otherwise false
     *
     * @return self
     */
    public function includeLabelRelations(bool $labelRelations = true): self
    {
        $this->labelRelations = $labelRelations;

        return $this;
    }
}
