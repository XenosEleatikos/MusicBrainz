<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait LabelNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the label's name (with accented characters).
     *
     * @return string
     */
    public static function labelNameWithAccents(): string
    {
        return 'labelaccent';
    }

    /**
     * Adds the label's name (with accented characters).
     *
     * @param Name $labelNameWithAccents The label's name (with accented characters)
     *
     * @return static
     */
    public function addLabelNameWithAccents(Name $labelNameWithAccents): static
    {
        $this->addPhrase((string) $labelNameWithAccents, self::labelNameWithAccents());

        return $this;
    }
}
