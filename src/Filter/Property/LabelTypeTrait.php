<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\LabelTypeKind;

trait LabelTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of label.
     *
     * @return string
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
     * @return Phrase
     */
    public function addLabelType(LabelTypeKind $labelType): Phrase
    {
        return $this->addPhrase($labelType->value, self::labelType());
    }
}
