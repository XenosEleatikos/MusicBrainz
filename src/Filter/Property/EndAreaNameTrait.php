<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\Name;

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
     * @return Phrase
     */
    public function addEndAreaName(Name $endAreaName): Phrase
    {
        return $this->addPhrase((string) $endAreaName, self::endAreaName());
    }
}
