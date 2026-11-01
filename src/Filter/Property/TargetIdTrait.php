<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\MBID;

trait TargetIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the MBID of an entity related to the URL.
     *
     * @return string
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
     * @return Term
     */
    public function addTargetId(MBID $targetId): Term
    {
        return $this->addTerm((string) $targetId, self::targetId());
    }
}
