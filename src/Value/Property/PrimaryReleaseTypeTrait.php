<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\PrimaryReleaseType;

/**
 * Provides a getter for the primary release type.
 */
trait PrimaryReleaseTypeTrait
{
    private ?PrimaryReleaseType $primaryReleaseType;

    /**
     * Returns the primary release type, or null if the web service did not deliver one.
     */
    public function getPrimaryReleaseType(): ?PrimaryReleaseType
    {
        return $this->primaryReleaseType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setPrimaryReleaseTypeFromArray(array $input): void
    {
        $this->primaryReleaseType = PrimaryReleaseType::fromArray($input, 'primary-type', 'primary-type-id');
    }
}
