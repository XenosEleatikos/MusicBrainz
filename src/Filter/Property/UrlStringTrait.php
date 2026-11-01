<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;

trait UrlStringTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the actual URL string.
     *
     * @return string
     */
    public static function urlString(): string
    {
        return 'url';
    }

    /**
     * Searches for the actual URL string.
     *
     * @param string $url
     *
     * @return Phrase
     */
    public function addUrl(string $url): Phrase
    {
        return $this->addPhrase($url, self::urlString());
    }
}
