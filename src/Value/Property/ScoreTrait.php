<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Score;

/**
 * Provides a getter for the relevance score for the search result.
 */
trait ScoreTrait
{
    /**
     * The relevance score for the search result
     *
     * @var Score
     */
    private Score $score;

    /**
     * Returns the relevance score for the search result.
     *
     * @return Score
     */
    public function getScore(): Score
    {
        return $this->score;
    }

    /**
     * Sets the score by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setScoreFromArray(array $input): void
    {
        $this->score = is_null($entityType = ArrayAccess::getString($input, 'score'))
            ? new Score()
            : new Score($entityType);
    }
}
