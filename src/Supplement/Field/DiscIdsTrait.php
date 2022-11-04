<?php

namespace MusicBrainz\Supplement\Field;

trait DiscIdsTrait
{
    /**
     * True, if disc ID's should be included, otherwise false
     *
     * @var bool
     */
    private bool $discIds = false;

    /**
     * Returns true, if disc ID's should be included, otherwise false.
     *
     * @return bool
     */
    public function getIncludeFlagForDiscIds(): bool
    {
        return $this->discIds;
    }

    /**
     * Sets whether disc ID's should be included.
     *
     * @param bool $discIds True, if disc ID's should be included, otherwise false
     *
     * @return static
     */
    public function includeDiscIds(bool $discIds = true): self
    {
        $this->discIds = $discIds;

        return $this;
    }
}
