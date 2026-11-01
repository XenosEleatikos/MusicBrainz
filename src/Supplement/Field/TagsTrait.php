<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait TagsTrait
{
    /**
     * True, if tags should be included, otherwise false
     *
     * @var bool
     */
    protected bool $tags = false;

    /**
     * Sets whether tags should be included.
     *
     * @param bool $tags True, if tags should be included, otherwise false
     *
     * @return self
     */
    public function includeTags(bool $tags = true): self
    {
        $this->tags = $tags;

        return $this;
    }
}
