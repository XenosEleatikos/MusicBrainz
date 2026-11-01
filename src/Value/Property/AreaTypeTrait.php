<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\AreaType;

/**
 * Provides a getter for an area type.
 */
trait AreaTypeTrait
{
    private ?AreaType $areaType;

    /**
     * Returns an area type, or null if the web service did not deliver one.
     */
    public function getAreaType(): ?AreaType
    {
        return $this->areaType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setAreaTypeFromArray(array $input): void
    {
        $this->areaType = AreaType::fromArray($input, 'type', 'type-id');
    }
}
