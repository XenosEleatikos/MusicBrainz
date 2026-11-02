<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\LabelTypeKind;

trait LabelTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of label.
     *
     * @return string
     *
     * @internal
     */
    public static function labelType(): string
    {
        return 'type';
    }

    /**
     * Adds the type of label.
     *
     * @param LabelTypeKind $labelType The type of label
     *
     * @return static
     */
    public function addLabelType(LabelTypeKind $labelType): static
    {
        $this->addPhrase($labelType->value, self::labelType());

        return $this;
    }
}
