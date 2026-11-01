<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\Packaging;

/**
 * Provides a getter for a packaging.
 */
trait PackagingTrait
{
    private ?Packaging $packaging;

    /**
     * Returns a packaging, or null if the web service did not deliver one.
     */
    public function getPackaging(): ?Packaging
    {
        return $this->packaging;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setPackagingFromArray(array $input): void
    {
        $this->packaging = Packaging::fromArray($input, 'packaging', 'packaging-id');
    }
}
