<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\Count;

trait ReleaseCountTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the amount of releases related to the label.
     *
     * @return string
     */
    public static function releaseCount(): string
    {
        return 'release_count';
    }

    /**
     * Searches for the amount of releases related to the label.
     *
     * @param Count $count
     *
     * @return Term
     */
    public function addReleaseCount(Count $count): Term
    {
        return $this->addTerm((string) $count, self::releaseCount());
    }
}
