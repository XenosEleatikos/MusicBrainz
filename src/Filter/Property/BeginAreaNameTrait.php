<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait BeginAreaNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the beginning area.
     *
     * @return string
     *
     * @internal
     */
    public static function beginAreaName(): string
    {
        return 'beginarea';
    }

    /**
     * Adds the name of the beginning area.
     *
     * @param Name $beginAreaName The name of the beginning area
     *
     * @return static
     */
    public function addBeginAreaName(Name $beginAreaName): static
    {
        $this->addPhrase((string) $beginAreaName, self::beginAreaName());

        return $this;
    }
}
