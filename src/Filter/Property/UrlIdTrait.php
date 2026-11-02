<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait UrlIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the URL's MBID.
     *
     * @return string
     *
     * @internal
     */
    public static function urlId(): string
    {
        return 'uid';
    }

    /**
     * Searches for the URL's MBID.
     *
     * @param MBID $urlId
     *
     * @return static
     */
    public function addUrlId(MBID $urlId): static
    {
        $this->addTerm((string) $urlId, self::urlId());

        return $this;
    }
}
