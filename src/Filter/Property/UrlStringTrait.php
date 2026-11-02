<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

trait UrlStringTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the actual URL string.
     *
     * @return string
     *
     * @internal
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
     * @return static
     */
    public function addUrl(string $url): static
    {
        $this->addPhrase($url, self::urlString());

        return $this;
    }
}
