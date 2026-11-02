<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\PrimaryReleaseTypeKind;
use MusicBrainz\Value\SecondaryReleaseTypeKind;

trait ReleaseGroupTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of the release group.
     *
     * @return string
     *
     * @internal
     */
    public static function releaseGroupType(): string
    {
        return 'type';
    }

    /**
     * Adds the type of the release group.
     *
     * @param PrimaryReleaseTypeKind|SecondaryReleaseTypeKind $releaseGroupType The type of the release group
     *
     * @return static
     */
    public function addReleaseGroupType(PrimaryReleaseTypeKind|SecondaryReleaseTypeKind $releaseGroupType): static
    {
        $this->addPhrase($releaseGroupType->value, self::releaseGroupType());

        return $this;
    }
}
