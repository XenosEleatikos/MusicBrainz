<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\ISNI;

trait IsniTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of an ISNI code associated with the entity.
     *
     * @return string
     *
     * @internal
     */
    public static function isni(): string
    {
        return 'isni';
    }

    /**
     * Searches for an ISNI code associated with the entity.
     *
     * @param ISNI $isni
     *
     * @return static
     */
    public function addIsni(ISNI $isni): static
    {
        $this->addTerm((string) $isni, self::isni());

        return $this;
    }
}
