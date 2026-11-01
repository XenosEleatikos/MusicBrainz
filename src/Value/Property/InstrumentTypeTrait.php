<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\InstrumentType;

/**
 * Provides a getter for an instrument type.
 */
trait InstrumentTypeTrait
{
    private ?InstrumentType $instrumentType;

    /**
     * Returns an instrument type, or null if the web service did not deliver one.
     */
    public function getInstrumentType(): ?InstrumentType
    {
        return $this->instrumentType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setInstrumentTypeFromArray(array $input): void
    {
        $this->instrumentType = InstrumentType::fromArray($input, 'type', 'type-id');
    }
}
