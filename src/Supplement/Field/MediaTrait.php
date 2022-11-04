<?php

namespace MusicBrainz\Supplement\Field;

trait MediaTrait
{
    /**
     * True, if media should be included, otherwise false
     *
     * @var bool
     */
    private bool $media = false;

    /**
     * Returns true, if media should be included, otherwise false.
     *
     * @return bool
     */
    public function getIncludeFlagForMedia(): bool
    {
        return $this->media;
    }

    /**
     * Sets whether media should be included.
     *
     * @param bool $media True, if media should be included, otherwise false
     *
     * @return self
     */
    public function includeMedia(bool $media = true): self
    {
        $this->media = $media;

        return $this;
    }
}
