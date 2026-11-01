<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait GenresTrait
{
    /**
     * True, if genres should be included, otherwise false
     *
     * @var bool
     */
    protected bool $genres = false;

    /**
     * Sets whether genres should be included.
     *
     * @param bool $genres True, if genres should be included, otherwise false
     *
     * @return self
     */
    public function includeGenres(bool $genres = true): self
    {
        $this->genres = $genres;

        return $this;
    }
}
