<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\ArtistType;

/**
 * Provides a getter for an artist type.
 */
trait ArtistTypeTrait
{
    private ?ArtistType $artistType;

    /**
     * Returns an artist type, or null if the web service did not deliver one.
     */
    public function getArtistType(): ?ArtistType
    {
        return $this->artistType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setArtistTypeFromArray(array $input): void
    {
        $this->artistType = ArtistType::fromArray($input, 'type', 'type-id');
    }
}
