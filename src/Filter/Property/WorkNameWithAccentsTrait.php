<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait WorkNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the work (with accented characters).
     *
     * @return string
     *
     * @internal
     */
    public static function workNameWithAccents(): string
    {
        return 'workaccent';
    }

    /**
     * Adds the name of the work (with accented characters).
     *
     * @param Name $workNameWithAccents The name of the work
     *
     * @return static
     */
    public function addWorkNameWithAccents(Name $workNameWithAccents): static
    {
        $this->addPhrase((string) $workNameWithAccents, self::workNameWithAccents());

        return $this;
    }
}
