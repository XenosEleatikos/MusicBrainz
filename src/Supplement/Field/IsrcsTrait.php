<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait IsrcsTrait
{
    /**
     * True, if ISRCs should be included, otherwise false
     *
     * @var bool
     */
    protected bool $isrcs = false;

    /**
     * Sets whether ISRCs should be included.
     *
     * @param bool $isrcs True, if ISRCs should be included, otherwise false
     *
     * @return self
     */
    public function includeIsrcs(bool $isrcs = true): self
    {
        $this->isrcs = $isrcs;

        return $this;
    }
}
