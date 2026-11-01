<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\AreaTypeKind;

trait AreaTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the area type.
     *
     * @return string
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
     * @return Term
     */
    public function addAreaType(AreaTypeKind $areaType): Term
    {
        return $this->addTerm($areaType->value, self::areaType());
    }
}
