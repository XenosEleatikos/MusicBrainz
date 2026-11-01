<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait ReleasesTrait
{
    /**
     * True, if releases should be included, otherwise false
     *
     * @var bool
     */
    protected bool $releases = false;

    /**
     * Sets whether releases should be included.
     *
     * @param bool $releases True, if releases should be included, otherwise false
     *
     * @return self
     */
    public function includeReleases(bool $releases = true): self
    {
        $this->releases = $releases;

        return $this;
    }
}
