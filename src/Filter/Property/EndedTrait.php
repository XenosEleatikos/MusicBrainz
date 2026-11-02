<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

trait EndedTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the "ended" flag.
     *
     * @return string
     *
     * @internal
     */
    public static function ended(): string
    {
        return 'ended';
    }

    /**
     * Adds a flag indicating whether or not the searched entity has ended.
     *
     * @param bool $ended A flag indicating whether or not the searched entity has ended
     *
     * @return static
     */
    public function addEnded(bool $ended): static
    {
        $this->addTerm($ended ? 'true' : 'false', self::ended());

        return $this;
    }
}
