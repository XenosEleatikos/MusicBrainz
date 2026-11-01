<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\WorkTypeKind;

trait WorkTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of work.
     *
     * @return string
     */
    public static function workType(): string
    {
        return 'type';
    }

    /**
     * Adds the type of work.
     *
     * @param WorkTypeKind $workType The type of work
     *
     * @return static
     */
    public function addWorkType(WorkTypeKind $workType): static
    {
        $this->addPhrase($workType->value, self::workType());

        return $this;
    }
}
