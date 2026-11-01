<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait CreditNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the credit name.
     *
     * @return string
     */
    public static function creditName(): string
    {
        return 'creditname';
    }

    /**
     * Adds a name credit.
     *
     * @param Name $creditName A name credit
     *
     * @return static
     */
    public function addCreditName(Name $creditName): static
    {
        $this->addPhrase((string) $creditName, self::creditName());

        return $this;
    }
}
