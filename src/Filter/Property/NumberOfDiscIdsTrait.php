<?php
namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\Count;
use MusicBrainz\Value\Country;

trait NumberOfDiscIdsTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the number of disc IDs.
     *
     * @return string
     */
    public static function numberOfDiscIds(): string
    {
        return 'discids';
    }

    /**
     * Adds the total number of cd ids over all mediums for the release.
     *
     * @param Count $numberOfDiscIds The total number of cd ids over all mediums for the release
     *
     * @return Term
     */
    public function addNumberOfDiscIds(Count $numberOfDiscIds): Term
    {
        return $this->addTerm($numberOfDiscIds, self::numberOfDiscIds());
    }
}