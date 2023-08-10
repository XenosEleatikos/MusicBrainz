<?php

namespace MusicBrainz\Test\Api\Browse;

use MusicBrainz\Filter\Browse\Relation\Entity\ArtistRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Supplement\Browse\ArtistFields;
use MusicBrainz\Test\Api\ApiTestCase;
use MusicBrainz\Value\ArtistType;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\Page\ArtistListPage;
use MusicBrainz\Value\Name;

/**
 * Unit tests for the browse artist request
 */
class ArtistTest extends ApiTestCase
{
    /**
     * Test instance of the artist list
     *
     * @var Artist[]|ArtistListPage
     */
    private static ArtistListPage $artistListPage;

    /**
     * Sets up a mock object of the abstract HTTP adapter and the MusicBrainz API client to be tested.
     *
     * @return void
     */
    public function setUp(): void
    {
        if (isset(self::$artistListPage)) {
            return;
        }

        parent::setUp();

        /** Setting up the mock object of the abstract HTTP adapter */
        $this->expectApiCall(
            'artist/',
            [
                'fmt'     => 'json',
                'limit'   => 25,
                'offset'  => 0,
                'area'    => '20619e36-fca8-4499-bcc8-be01a3ea3e41',
                'inc'     => 'aliases+annotation+genres+tags+user-genres+user-tags'
            ],
            'Browse/Artist.json'
        );

        /** Performing the test */
        $artistRelation = new ArtistRelation;
        $artistRelation->area(new MBID('20619e36-fca8-4499-bcc8-be01a3ea3e41'));

        $artistFields = (new ArtistFields)
            ->includeAliases()
            ->includeAnnotation()
            ->includeGenres()
            ->includeTags()
            ->includeUserGenres()
            ->includeUserTags();

        self::$artistListPage = $this->musicBrainz->api()->browse()->artist($artistRelation, $artistFields, new PageFilter);
    }

    /**
     * Checks the artist list.
     *
     * @return void
     */
    public function testArtistListPage(): void
    {
        $artistListPage = self::$artistListPage;

        $this->assertInstanceOf(ArtistListPage::class, $artistListPage);
        $this->assertSame(25, count($artistListPage));

        $artist = $artistListPage[0];

        $this->assertInstanceOf(Artist::class, $artist);
    }

    /**
     * Checks the artist.
     *
     * @return void
     */
    public function testArtist(): void
    {
        $artist = self::$artistListPage[0];

        $this->assertInstanceOf(Artist::class, $artist);

        $this->assertInstanceOf(ArtistType::class, $artist->getArtistType());
        $this->assertEquals('Group', $artist->getArtistType());
        $this->assertInstanceOf(MBID::class, $artist->getArtistType()->getMBID());
        $this->assertEquals('e431f5f6-b5d2-343d-8b36-72607fffb74b', $artist->getArtistType()->getMBID());

        /** @todo Test disambiguation */
        /** @todo Test ratings */
        /** @todo Test aliases */
        /** @todo Test IPIs */
        /** @todo Test country */

        $this->assertInstanceOf(Name::class, $artist->getArtistName());
        $this->assertEquals('Amnistia', $artist->getArtistName());

        /** @todo Test ISNIs */
        /** @todo Test lifespan */
        /** @todo Test begin area */
        /** @todo Test end area */
        /** @todo Test annotation */
        /** @todo Test area */
    }
}
