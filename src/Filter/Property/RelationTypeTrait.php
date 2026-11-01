<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;

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
     * @return Phrase
     */
    public function addRelationType(string $relationType): Phrase
    {
        return $this->addPhrase($relationType, self::relationType());
    }
}
