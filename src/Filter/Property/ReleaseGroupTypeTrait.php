<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\PrimaryReleaseTypeKind;
use MusicBrainz\Value\SecondaryReleaseTypeKind;

trait ReleaseGroupTypeTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the type of the release group.
     *
     * @return string
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
     * @return Phrase
     */
    public function addReleaseGroupType(PrimaryReleaseTypeKind|SecondaryReleaseTypeKind $releaseGroupType): Phrase
    {
        return $this->addPhrase($releaseGroupType->value, self::releaseGroupType());
    }
}
