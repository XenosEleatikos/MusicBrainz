<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait TagNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the tag name.
     *
     * @return string
     */
    public static function tagName(): string
    {
        return 'tag';
    }

    /**
     * Adds a tag name.
     *
     * @param Name $tagName The tag name
     *
     * @return static
     */
    public function addTagName(Name $tagName): static
    {
        $this->addPhrase((string) $tagName, self::tagName());

        return $this;
    }
}
