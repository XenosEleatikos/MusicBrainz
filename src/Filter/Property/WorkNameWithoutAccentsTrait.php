<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait WorkNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the work.
     *
     * @return string
     */
    public static function workNameWithoutAccents(): string
    {
        return 'work';
    }

    /**
     * Adds the name of the work.
     *
     * @param Name $workNameWithoutAccents The name of the work
     *
     * @return static
     */
    public function addWorkNameWithoutAccents(Name $workNameWithoutAccents): static
    {
        $this->addPhrase((string) $workNameWithoutAccents, self::workNameWithoutAccents());

        return $this;
    }
}
