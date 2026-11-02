<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ReleaseGroupNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the name of the release group (without accents).
     *
     * @return string
     *
     * @internal
     */
    public static function releaseGroupName(): string
    {
        return 'releasegroup';
    }

    /**
     * Adds the name of the release group (without accents).
     *
     * @param Name $releaseGroupNameWithoutAccents The name of the release group (without accents)
     *
     * @return static
     */
    public function addReleaseGroupName(Name $releaseGroupNameWithoutAccents): static
    {
        $this->addPhrase((string) $releaseGroupNameWithoutAccents, self::releaseGroupName());

        return $this;
    }
}
