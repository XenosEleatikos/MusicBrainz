<?php
namespace MusicBrainz\Test\Api\Lookup;

use MusicBrainz\Relation\Target\RelationList\RelationToAreaList;
use MusicBrainz\Relation\Target\RelationList\RelationToArtistList;
use MusicBrainz\Relation\Target\RelationList\RelationToEventList;
use MusicBrainz\Relation\Target\RelationList\RelationToInstrumentList;
use MusicBrainz\Relation\Target\RelationList\RelationToLabelList;
use MusicBrainz\Relation\Target\RelationList\RelationToPlaceList;
use MusicBrainz\Relation\Target\RelationList\RelationToRecordingList;
use MusicBrainz\Relation\Target\RelationList\RelationToReleaseGroupList;
use MusicBrainz\Relation\Target\RelationList\RelationToSeriesList;
use MusicBrainz\Relation\Target\RelationList\RelationToUrlList;
use MusicBrainz\Relation\Target\RelationList\RelationToReleaseList;
use MusicBrainz\Supplement\Lookup\InstrumentFields;
use MusicBrainz\Test\Api\ApiTestCase;
use MusicBrainz\Value\Area;
use MusicBrainz\Value\Instrument;
use MusicBrainz\Value\Country;
use MusicBrainz\Value\DataQuality;
use MusicBrainz\Value\Date;
use MusicBrainz\Value\Disc;
use MusicBrainz\Value\DiscId;
use MusicBrainz\Value\DiscList;
use MusicBrainz\Value\Format;
use MusicBrainz\Value\ISO31661Code;
use MusicBrainz\Value\ISO31661CodeList;
use MusicBrainz\Value\Language;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\MediaList;
use MusicBrainz\Value\Medium;
use MusicBrainz\Value\Release;
use MusicBrainz\Value\ReleaseEvent;
use MusicBrainz\Value\ReleaseEventList;
use MusicBrainz\Value\ReleaseList;
use MusicBrainz\Value\ReleaseStatus;
use MusicBrainz\Value\Script;
use MusicBrainz\Value\SectorOffsetList;
use MusicBrainz\Value\Sectors;
use MusicBrainz\Value\Name;
use MusicBrainz\Value\TextRepresentation;
use MusicBrainz\Value\Title;

/**
 * Unit tests for the lookup API.
 */
class InstrumentTest extends ApiTestCase
{
    /**
     * Test instance of the artist
     *
     * @var Instrument
     */
    private static Instrument $instrument;

    /**
     * Sets up a mock object of the abstract HTTP adapter and the MusicBrainz API client to be tested.
     *
     * @return void
     */
    public function setUp(): void
    {
        if (isset(self::$instrument)) {
            return;
        }

        parent::setUp();

        /**
         * Setting up the mock object of the abstract HTTP adapter
         */
        $this->expectApiCall(
            'instrument/7ee8ebf5-3aed-4fc8-8004-49f4a8c45a87',
            [
                'fmt' => 'json',
                    'inc' => 'area-rels+artist-rels+instrument-rels+label-rels+url-rels'
            ],
            'Lookup/Instrument.json'
        );

        /**
         * Performing the test
         */
        $fields = (new InstrumentFields)
            ->includeAreaRelations()
            ->includeArtistRelations()
            ->includeInstrumentRelations()
            ->includeLabelRelations()
            ->includeURLRelations();

        self::$instrument = $this->musicBrainz->api()->lookup()->instrument(
            new MBID('7ee8ebf5-3aed-4fc8-8004-49f4a8c45a87'),
            $fields
        );
    }

    /**
     * Checks the instrument.
     *
     * @return void
     */
    public function testInstrument(): void
    {
        $artist = self::$instrument;

        $this->assertInstanceOf(Instrument::class, $artist);
    }

    public function testRelations(): void
    {
        $relationList = self::$instrument->getRelations();

        $this->assertInstanceOf(\MusicBrainz\Relation\RelationList\InstrumentRelationList::class, $relationList);
        $this->assertInstanceOf(RelationToAreaList::class, $relationList->getAreaRelations());
        $this->assertInstanceOf(RelationToArtistList::class, $relationList->getArtistRelations());
        $this->assertInstanceOf(RelationToInstrumentList::class, $relationList->getInstrumentRelations());
        $this->assertInstanceOf(RelationToLabelList::class, $relationList->getLabelRelations());
        $this->assertInstanceOf(RelationToUrlList::class, $relationList->getUrlRelations());
    }
}
