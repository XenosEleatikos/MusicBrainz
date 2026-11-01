<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ReleaseNameWithoutAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release name (without accents).
     *
     * @return string
     */
    public static function releaseNameWithoutAccents(): string
    {
        return 'release';
    }

    /**
     * Adds the name of a release (without accents).
     *
     * @param Name $releaseNameWithoutAccents The name of a release
     *
     * @return static
     */
    public function addReleaseName(Name $releaseNameWithoutAccents): static
    {
        $this->addPhrase((string) $releaseNameWithoutAccents, self::releaseNameWithoutAccents());

        return $this;
    }
}
