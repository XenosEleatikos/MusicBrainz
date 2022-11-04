<?php
namespace MusicBrainz\Test\Api\Browse;

use MusicBrainz\Filter\Browse\Relation\Entity\LabelRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Supplement\Browse\LabelFields;
use MusicBrainz\Test\Api\ApiTestCase;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Label;
use MusicBrainz\Value\Page\LabelListPage;

/**
 * Unit tests for the browse label request
 */
class LabelTest extends ApiTestCase
{
    /**
     * Test instance of the artist list
     *
     * @var Label[]|LabelListPage
     */
    private static LabelListPage $labelListPage;

    /**
     * Sets up a mock object of the abstract HTTP adapter and the MusicBrainz API client to be tested.
     *
     * @return void
     */
    public function setUp(): void
    {
        if (isset(self::$labelListPage)) {
            return;
        }

        parent::setUp();

        /** Setting up the mock object of the abstract HTTP adapter */
        $this->expectApiCall(
            'label/',
            [
                'fmt'    => 'json',
                'limit'  => 25,
                'offset' => 0,
                'area'   => '20619e36-fca8-4499-bcc8-be01a3ea3e41',
                'inc'    => 'aliases+annotation+ratings+tags+user-ratings+user-tags'
            ],
            'Browse/Label.json'
        );

        /** Performing the test */
        $labelRelation = new LabelRelation;
        $labelRelation->area(new MBID('20619e36-fca8-4499-bcc8-be01a3ea3e41'));

        $labelFields = (new LabelFields)
            ->includeAliases()
            ->includeAnnotation()
            ->includeRatings()
            ->includeTags()
            ->includeUserRatings()
            ->includeUserTags();

        self::$labelListPage = $this->musicBrainz->api()->browse()->label($labelRelation, $labelFields, new PageFilter);
    }

    /**
     * Checks the label list.
     *
     * @return void
     */
    public function testLabelListPage(): void
    {
        $labelListPage = self::$labelListPage;

        $this->assertInstanceOf(LabelListPage::class, $labelListPage);
        $this->assertSame(25, count($labelListPage));

        $label = $labelListPage[0];

        $this->assertInstanceOf(Label::class, $label);
    }
}
