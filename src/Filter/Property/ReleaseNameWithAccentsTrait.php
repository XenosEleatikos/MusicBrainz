<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ReleaseNameWithAccentsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release name (with accents).
     *
     * @return string
     *
     * @internal
     */
    public static function releaseNameWithAccents(): string
    {
        return 'releaseaccent';
    }

    /**
     * Adds the name of a release (with accents).
     *
     * @param Name $releaseNameWithAccents The name of a release (with accents)
     *
     * @return static
     */
    public function addReleaseNameWithAccents(Name $releaseNameWithAccents): static
    {
        $this->addPhrase((string) $releaseNameWithAccents, self::releaseNameWithAccents());

        return $this;
    }
}
