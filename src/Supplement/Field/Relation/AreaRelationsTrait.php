<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait AreaRelationsTrait
{
    /**
     * True, if area relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $areaRelations = false;

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
