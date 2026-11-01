<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field\Relation;

trait GenreRelationsTrait
{
    /**
     * True, if genre relations should be included, otherwise false
     *
     * @var bool
     */
    protected bool $genreRelations = false;

    /**
     * Returns true, if genre relations should be included, otherwise false.
     *
     * @return bool
     */
    public function getIncludeFlagForGenreRelations(): bool
    {
        return $this->genreRelations;
    }

    /**
     * Sets whether genre relations should be included.
     *
     * @param bool $genreRelations True, if genre relations should be included, otherwise false
     *
     * @return self
     */
    public function includeGenreRelations(bool $genreRelations = true): self
    {
        $this->genreRelations = $genreRelations;

        return $this;
    }
}
