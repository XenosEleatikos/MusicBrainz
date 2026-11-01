<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\LabelType;

/**
 * Provides a getter for a label type.
 */
trait LabelTypeTrait
{
    private ?LabelType $labelType;

    /**
     * Returns a label type, or null if the web service did not deliver one.
     */
    public function getLabelType(): ?LabelType
    {
        return $this->labelType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setLabelTypeFromArray(array $input): void
    {
        $this->labelType = LabelType::fromArray($input, 'type', 'type-id');
    }
}
