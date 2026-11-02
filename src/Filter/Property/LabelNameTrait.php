<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait LabelNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the label's name (without accented characters).
     *
     * @return string
     *
     * @internal
     */
    public static function labelName(): string
    {
        return 'label';
    }

    /**
     * Adds the label's name (without accented characters).
     *
     * @param Name $labelName The label's name (without accented characters)
     *
     * @return static
     */
    public function addLabelName(Name $labelName): static
    {
        $this->addPhrase((string) $labelName, self::labelName());

        return $this;
    }
}
