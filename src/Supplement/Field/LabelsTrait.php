<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait LabelsTrait
{
    /**
     * True, if labels should be included, otherwise false
     *
     * @var bool
     */
    protected bool $labels = false;

    /**
     * Sets whether labels should be included.
     *
     * @param bool $labels True, if labels should be included, otherwise false
     *
     * @return self
     */
    public function includeLabels(bool $labels = true): self
    {
        $this->labels = $labels;

        return $this;
    }
}
