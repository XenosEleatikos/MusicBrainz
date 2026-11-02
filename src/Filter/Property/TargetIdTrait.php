<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait TargetIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the MBID of an entity related to the URL.
     *
     * @return string
     *
     * @internal
     */
    public static function targetId(): string
    {
        return 'targetid';
    }

    /**
     * Searches for the MBID of an entity related to the URL.
     *
     * @param MBID $targetId
     *
     * @return static
     */
    public function addTargetId(MBID $targetId): static
    {
        $this->addTerm((string) $targetId, self::targetId());

        return $this;
    }
}
