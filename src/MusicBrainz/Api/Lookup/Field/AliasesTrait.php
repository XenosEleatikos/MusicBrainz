<?php

namespace MusicBrainz\Api\Lookup\Field;

trait AliasesTrait
{
    /**
     * True, if aliases should be included, otherwise false
     *
     * @var bool
     */
    private $aliases = false;

    /**
     * Returns true, if aliases should be included, otherwise false.
     *
     * @return bool
     */
    public function isAliases(): bool
    {
        return $this->aliases;
    }

    /**
     * Sets whether aliases should be included.
     *
     * @param bool $aliases True, if aliases should be included, otherwise false
     *
     * @return self
     */
    public function setAliases(bool $aliases = true): self
    {
        $this->aliases = $aliases;

        return $this;
    }
}
