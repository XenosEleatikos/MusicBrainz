<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait WorkRelationsTrait
{
    /**
     * True, if work relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $workRelations = false;

    /**
     * Sets whether work relations should be included.
     *
     * @param bool $workRelations True, if work relations should be included, otherwise false
     *
     * @return self
     */
    public function includeWorkRelations(bool $workRelations = true): self
    {
        $this->workRelations = $workRelations;

        return $this;
    }
}
