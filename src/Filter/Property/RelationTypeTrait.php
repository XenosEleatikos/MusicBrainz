<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

trait RelationTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the type of a relationship the URL is in.
     *
     * @return string
     */
    public static function relationType(): string
    {
        return 'relationtype';
    }

    /**
     * Searches for the type of a relationship the URL is in (e.g. "wikidata").
     *
     * @param string $relationType
     *
     * @return static
     */
    public function addRelationType(string $relationType): static
    {
        $this->addPhrase($relationType, self::relationType());

        return $this;
    }
}
