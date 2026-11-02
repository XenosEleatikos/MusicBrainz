<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\IPI;

trait IpiTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the IPI (interested party information) code.
     *
     * @return string
     *
     * @internal
     */
    public static function ipi(): string
    {
        return 'ipi';
    }

    /**
     * Adds an IPI (interested party information) code.
     *
     * @param IPI $ipi An IPI (interested party information) code
     *
     * @return static
     */
    public function addIpi(IPI $ipi): static
    {
        $this->addTerm((string) $ipi, self::ipi());

        return $this;
    }
}
