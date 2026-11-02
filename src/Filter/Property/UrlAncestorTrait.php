<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

trait UrlAncestorTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the actual URL string, but also returns any ancestor paths.
     *
     * @return string
     *
     * @internal
     */
    public static function urlAncestor(): string
    {
        return 'url_ancestor';
    }

    /**
     * Searches for the actual URL string, but also returns any ancestor paths (e.g. "https://example.org/some/stuff" will match "https://example.org/some").
     *
     * @param string $url
     *
     * @return static
     */
    public function addUrlAncestor(string $url): static
    {
        $this->addPhrase($url, self::urlAncestor());

        return $this;
    }
}
