<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;
use MusicBrainz\Value\Property;

/**
 * Label information
 */
class LabelInfo implements Value
{
    use Property\CatalogueNumberTrait;
    use Property\LabelTrait;

    /**
     * Constructs label information.
     *
     * @param array $labelInfo Array of information about label information
     */
    public function __construct(array $labelInfo = [])
    {
        $this->setCatalogueNumberFromArray($labelInfo);
        $this->setLabelFromArray($labelInfo);
    }

    /**
     * Returns the label as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getCatalogueNumber();
    }
}
