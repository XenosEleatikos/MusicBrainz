<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
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
     * @return Phrase
     */
    public function addWorkType(WorkTypeKind $workType): Phrase
    {
        return $this->addPhrase($workType->value, self::workType());
    }
}
