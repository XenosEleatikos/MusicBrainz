<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\Tag;

/**
 * Provides a getter for a Tag.
 */
trait TagTrait
{
    /**
     * The Tag number
     *
     * @var Tag
     */
    public $Tag;

    /**
     * Returns the Tag.
     *
     * @return Tag
     */
    public function getTag(): Tag
    {
        return $this->Tag;
    }
}
