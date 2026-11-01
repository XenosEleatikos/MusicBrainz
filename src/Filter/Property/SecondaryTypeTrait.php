<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\SecondaryReleaseTypeKind;

trait SecondaryTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the secondary release type.
     *
     * @return string
     */
    public static function secondaryType(): string
    {
        return 'secondarytype';
    }

    /**
     * Adds the secondary release type of the release group.
     *
     * @param SecondaryReleaseTypeKind $secondaryType The secondary release type of the release group
     *
     * @return static
     */
    public function addSecondaryType(SecondaryReleaseTypeKind $secondaryType): static
    {
        $this->addPhrase($secondaryType->value, self::secondaryType());

        return $this;
    }
}
