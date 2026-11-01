<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
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
     * @return Phrase
     */
    public function addSecondaryType(SecondaryReleaseTypeKind $secondaryType): Phrase
    {
        return $this->addPhrase($secondaryType->value, self::secondaryType());
    }
}
