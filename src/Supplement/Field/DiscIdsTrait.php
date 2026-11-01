<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait DiscIdsTrait
{
    /**
     * True, if disc ID's should be included, otherwise false
     *
     * @var bool
     */
    protected bool $discids = false;

    /**
     * Sets whether disc ID's should be included.
     *
     * @param bool $discIds True, if disc ID's should be included, otherwise false
     *
     * @return static
     */
    public function includeDiscIds(bool $discIds = true): self
    {
        $this->discids = $discIds;

        return $this;
    }
}
