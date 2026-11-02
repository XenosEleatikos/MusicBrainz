<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\AreaTypeKind;

trait AreaTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the area type.
     *
     * @return string
     *
     * @internal
     */
    public static function areaType(): string
    {
        return 'type';
    }

    /**
     * Adds the area type.
     *
     * @param AreaTypeKind $areaType The area type
     *
     * @return static
     */
    public function addAreaType(AreaTypeKind $areaType): static
    {
        $this->addPhrase($areaType->value, self::areaType());

        return $this;
    }
}
