<?php

namespace MusicBrainz\Relation\Target;

use MusicBrainz\Relation;
use MusicBrainz\Value\Instrument;
use MusicBrainz\Value\EntityType;

/**
 * An instrument relation
 */
class RelationToInstrument extends Relation
{
    /**
     * The related instrument
     *
     * @var Instrument
     */
    private $instrument;

    /**
     * Sets the related instrument.
     *
     * @param array $instrument Information about the related instrument
     *
     * @return void
     */
    protected function setRelatedEntity(array $instrument): void
    {
        $this->instrument = new Instrument($instrument);
    }

    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    public static function getRelatedEntityType(): EntityType
    {
        return new EntityType(EntityType::INSTRUMENT);
    }

    /**
     * Returns the related instrument.
     *
     * @return Instrument
     */
    public function getInstrument(): Instrument
    {
        return $this->instrument;
    }
}
