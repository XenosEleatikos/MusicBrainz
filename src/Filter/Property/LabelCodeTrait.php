<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\LabelCode;

trait LabelCodeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the Label Code (LC).
     *
     * @return string
     */
    public static function labelCode(): string
    {
        return 'code';
    }

    /**
     * Adds the Label Code (LC) of the label.
     *
     * @param LabelCode $labelCode The Label Code (LC) of the label
     *
     * @return static
     */
    public function addLabelCode(LabelCode $labelCode): static
    {
        $this->addTerm($labelCode->withoutPrefix(), self::labelCode());

        return $this;
    }
}
