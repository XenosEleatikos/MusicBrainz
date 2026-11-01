<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;

trait UrlDescendentTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the actual URL string, but also returns any descendant paths.
     *
     * @return string
     */
    public static function urlDescendent(): string
    {
        return 'url_descendent';
    }

    /**
     * Searches for the actual URL string, but also returns any descendant paths (e.g. "https://example.org/some/stuff" will match "https://example.org/some/stuff/here").
     *
     * @param string $url
     *
     * @return Phrase
     */
    public function addUrlDescendent(string $url): Phrase
    {
        return $this->addPhrase($url, self::urlDescendent());
    }
}
