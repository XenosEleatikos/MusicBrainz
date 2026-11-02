<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait CollectionsTrait
{
    /**
     * True, if collections should be included, otherwise false
     *
     * @var bool
     */
    protected bool $collections = false;

    /**
     * Sets whether collections should be included.
     *
     * @param bool $collections True, if collections should be included, otherwise false
     *
     * @return self
     */
    public function includeCollections(bool $collections = true): self
    {
        $this->collections = $collections;

        return $this;
    }
}
