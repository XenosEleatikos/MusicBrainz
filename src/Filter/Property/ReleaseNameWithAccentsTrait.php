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
     */
    public static function releaseNameWithAccent(): string
    {
        return 'releaseaccent';
    }

    /**
     * Adds the name of a release (with accents).
     *
     * @param Name $releaseNameWithAccent The name of a release (with accents)
     *
     * @return static
     */
    public function addReleaseNameWithAccent(Name $releaseNameWithAccent): static
    {
        $this->addPhrase((string) $releaseNameWithAccent, self::releaseNameWithAccent());

        return $this;
    }
}
