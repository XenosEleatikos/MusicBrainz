<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait WorkLevelRelationsTrait
{
    /**
     * True, if work level relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $workLevelRelations = false;

    /**
     * Sets whether work level relations should be included.
     *
     * @param bool $workLevelRelations True, if work level relations should be included, otherwise false
     *
     * @return self
     */
    public function includeWorkLevelRelations(bool $workLevelRelations = true): self
    {
        $this->workLevelRelations = $workLevelRelations;

        return $this;
    }
}
