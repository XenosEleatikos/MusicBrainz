<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\ISNI;

trait IsniCodeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of an ISNI code associated with the entity.
     *
     * @return string
     */
    public static function isniCode(): string
    {
        return 'isni';
    }

    /**
     * Searches for an ISNI code associated with the entity.
     *
     * @param ISNI $isni
     *
     * @return Term
     */
    public function addIsniCode(ISNI $isni): Term
    {
        return $this->addTerm((string) $isni, self::isniCode());
    }
}
