<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait SortNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the sort name.
     *
     * @return string
     *
     * @internal
     */
    public static function sortName(): string
    {
        return 'sortname';
    }

    /**
     * Adds the sort name.
     *
     * @param Name $sortName The sort name
     *
     * @return static
     */
    public function addSortName(Name $sortName): static
    {
        $this->addPhrase((string) $sortName, self::sortName());

        return $this;
    }
}
