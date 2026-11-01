<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\GenderKind;

trait GenderTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the gender.
     *
     * @return string
     */
    public static function gender(): string
    {
        return 'gender';
    }

    /**
     * Adds a gender.
     *
     * @param GenderKind $gender A gender
     *
     * @return Term
     */
    public function addGender(GenderKind $gender): Term
    {
        return $this->addTerm($gender->value, self::gender());
    }
}
