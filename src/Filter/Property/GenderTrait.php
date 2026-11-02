<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\GenderKind;

trait GenderTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the gender.
     *
     * @return string
     *
     * @internal
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
     * @return static
     */
    public function addGender(GenderKind $gender): static
    {
        $this->addPhrase($gender->value, self::gender());

        return $this;
    }
}
