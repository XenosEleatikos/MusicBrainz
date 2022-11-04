<?php

namespace MusicBrainz\Relation\Target\RelationList\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Relation\Target\RelationToInstrument;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Relation\Target\RelationList\RelationToInstrumentList;

/**
 * Provides a getter for the list of relations to an instrument.
 */
trait RelationsToInstrumentTrait
{
    /**
     * A list of relations to an instrument
     *
     * @var RelationToInstrument[]|RelationToInstrumentList
     */
    private $instrumentRelations;

    /**
     * Returns a list of relations to an instrument.
     *
     * @return RelationToInstrument[]|RelationToInstrumentList
     */
    public function getInstrumentRelations(): RelationToInstrumentList
    {
        return $this->instrumentRelations;
    }

    /**
     * Sets a list of relations to an instrument by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setInstrumentRelationsFromArray(array $input): void
    {
        $this->instrumentRelations = is_null($input = ArrayAccess::getArray($input, EntityType::INSTRUMENT))
            ? new RelationToInstrumentList()
            : new RelationToInstrumentList($input);
    }
}
