<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\PrimaryReleaseTypeKind;

trait PrimaryTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the primary release type.
     *
     * @return string
     */
    public static function primaryType(): string
    {
        return 'primarytype';
    }

    /**
     * Adds the primary release type of the release group.
     *
     * @param PrimaryReleaseTypeKind $primaryType The primary release type of the release group
     *
     * @return static
     */
    public function addPrimaryType(PrimaryReleaseTypeKind $primaryType): static
    {
        $this->addPhrase($primaryType->value, self::primaryType());

        return $this;
    }
}
