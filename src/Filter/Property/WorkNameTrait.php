<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait WorkNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the work.
     *
     * @return string
     *
     * @internal
     */
    public static function workName(): string
    {
        return 'work';
    }

    /**
     * Adds the name of the work.
     *
     * @param Name $workName The name of the work
     *
     * @return static
     */
    public function addWorkName(Name $workName): static
    {
        $this->addPhrase((string) $workName, self::workName());

        return $this;
    }
}
