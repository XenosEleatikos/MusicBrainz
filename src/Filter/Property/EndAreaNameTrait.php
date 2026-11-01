<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait EndAreaNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the ending area.
     *
     * @return string
     */
    public static function endAreaName(): string
    {
        return 'endarea';
    }

    /**
     * Adds the name of the ending area.
     *
     * @param Name $endAreaName The name of the ending area
     *
     * @return static
     */
    public function addEndAreaName(Name $endAreaName): static
    {
        $this->addPhrase((string) $endAreaName, self::endAreaName());

        return $this;
    }
}
