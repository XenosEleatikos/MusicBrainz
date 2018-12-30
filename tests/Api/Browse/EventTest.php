<?php
namespace MusicBrainz\Test\Api\Browse;

use MusicBrainz\Filter\Browse\Relation\Entity\EventRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Supplement\Browse\EventFields;
use MusicBrainz\Test\Api\ApiTestCase;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Event;
use MusicBrainz\Value\Page\EventListPage;

/**
 * Unit tests for the browse event request
 */
class EventTest extends ApiTestCase
{
    /**
     * Test instance of the artist list
     *
     * @var Event[]|EventListPage
     */
    private static $eventListPage;

    /**
     * Sets up a mock object of the abstract HTTP adapter and the MusicBrainz API client to be tested.
     *
     * @return void
     */
    public function setUp(): void
    {
        if (!is_null(self::$eventListPage)) {
            return;
        }

        parent::setUp();

        /** Setting up the mock object of the abstract HTTP adapter */
        $this->expectApiCall(
            'event/',
            [
                'fmt'        => 'json',
                'limit'      => 25,
                'offset'     => 0,
                'artist'     => 'c3aeb863-7b26-4388-94e8-5a240f2be21b',
                'inc'        => 'aliases+annotation+ratings+tags+user-ratings+user-tags'
            ],
            'Browse/Event.json'
        );

        /** Performing the test */
        $eventRelation = new EventRelation;
        $eventRelation->artist(new MBID('c3aeb863-7b26-4388-94e8-5a240f2be21b'));

        $eventFields = (new EventFields)
            ->includeAliases()
            ->includeAnnotation()
            ->includeRatings()
            ->includeTags()
            ->includeUserRatings()
            ->includeUserTags();

        self::$eventListPage = $this->musicBrainz->api()->browse()->event($eventRelation, $eventFields, new PageFilter);
    }

    /**
     * Checks the event list.
     *
     * @return void
     */
    public function testEventListPage(): void
    {
        $eventListPage = self::$eventListPage;

        $this->assertInstanceOf(EventListPage::class, $eventListPage);
        $this->assertSame(18, count($eventListPage));

        $event = $eventListPage[0];

        $this->assertInstanceOf(Event::class, $event);
    }
}
