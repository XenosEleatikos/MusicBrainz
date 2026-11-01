<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait ReleaseGroupLevelRelationsTrait
{
    /**
     * True, if release group level relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $releaseGroupLevelRelations = false;

    /**
     * Sets whether release group level relations should be included.
     *
     * @param bool $releaseGroupLevelRelations True, if release group level relations should be included, otherwise false
     *
     * @return self
     */
    public function includeReleaseGroupLevelRelations(bool $releaseGroupLevelRelations = true): self
    {
        $this->releaseGroupLevelRelations = $releaseGroupLevelRelations;

        return $this;
    }
}
