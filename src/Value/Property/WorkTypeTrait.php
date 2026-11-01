<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\WorkType;

/**
 * Provides a getter for a work type.
 */
trait WorkTypeTrait
{
    private ?WorkType $workType;

    /**
     * Returns a work type, or null if the web service did not deliver one.
     */
    public function getWorkType(): ?WorkType
    {
        return $this->workType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setWorkTypeFromArray(array $input): void
    {
        $this->workType = WorkType::fromArray($input, 'type', 'type-id');
    }
}
