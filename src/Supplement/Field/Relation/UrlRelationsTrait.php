<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait UrlRelationsTrait
{
    /**
     * True, if URL relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $UrlRelations = false;

    /**
     * Returns true, if URL relations should be included, otherwise false.
     *
     * @return bool
     */
    public function getIncludeFlagForURLRelations(): bool
    {
        return $this->UrlRelations;
    }

    /**
     * Sets whether URL relations should be included.
     *
     * @param bool $URLRelations True, if URL relations should be included, otherwise false
     *
     * @return self
     */
    public function includeUrlRelations(bool $URLRelations = true): self
    {
        $this->UrlRelations = $URLRelations;

        return $this;
    }
}
