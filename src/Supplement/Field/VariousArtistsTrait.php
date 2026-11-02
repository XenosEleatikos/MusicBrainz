<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait VariousArtistsTrait
{
    /**
     * True, if various artists should be included, otherwise false
     *
     * @var bool
     */
    protected bool $variousArtists = false;

    /**
     * Sets whether various artists should be included.
     *
     * @param bool $variousArtists True, if various artists should be included, otherwise false
     *
     * @return self
     */
    public function includeVariousArtists(bool $variousArtists = true): self
    {
        $this->variousArtists = $variousArtists;

        return $this;
    }
}
