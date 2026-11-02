<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\ISO31662Code;

trait Iso31662CodeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the ISO 3166-2 code.
     *
     * @return string
     *
     * @internal
     */
    public static function iso31662Code(): string
    {
        return 'iso2';
    }

    /**
     * Adds the ISO 3166-2 code.
     *
     * @param ISO31662Code $iso31662Code The ISO 3166-2 code
     *
     * @return static
     */
    public function addIso31662Code(ISO31662Code $iso31662Code): static
    {
        $this->addTerm((string) $iso31662Code, self::iso31662Code());

        return $this;
    }
}
