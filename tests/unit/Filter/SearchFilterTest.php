<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use MusicBrainz\Filter\Search\AreaFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Filter\Search\PlaceFilter;
use MusicBrainz\Filter\Search\ReleaseFilter;
use MusicBrainz\Filter\Search\ReleaseGroupFilter;
use MusicBrainz\Filter\Search\WorkFilter;
use MusicBrainz\Filter\Value\ASIN;
use MusicBrainz\Filter\Value\CatalogNumber;
use MusicBrainz\Filter\Value\Count;
use MusicBrainz\Filter\Value\ISO31661Code;
use MusicBrainz\Filter\Value\ISWC;
use MusicBrainz\Filter\Value\Latitude;
use MusicBrainz\Filter\Value\Longitude;
use MusicBrainz\Value\MBID;
use MusicBrainz\Filter\Value\Name;
use MusicBrainz\Value\MediumFormatKind;
use PHPUnit\Framework\TestCase;

/**
 * The search fields documented at https://musicbrainz.org/doc/MusicBrainz_API/Search
 */
final class SearchFilterTest extends TestCase
{
    public function testReleaseSearchFields(): void
    {
        $filter = new ReleaseFilter();
        $filter->addASIN(new ASIN('B000003Z4N'));
        $filter->addCatalogNumber(new CatalogNumber('PCS 7088'));

        self::assertSame('asin:B000003Z4N AND catno:"PCS 7088"', (string) $filter);
    }

    public function testWorkSearchFields(): void
    {
        $filter = new WorkFilter();
        $filter->addIswc(new ISWC('T-010.140.234-6'));
        $filter->addWorkId(new MBID('41c94a08-a551-3c86-bb17-d9a52e3a618b'));

        self::assertSame('iswc:T\-010.140.234\-6 AND wid:41c94a08\-a551\-3c86\-bb17\-d9a52e3a618b', (string) $filter);
    }

    public function testReleaseGroupSearchFields(): void
    {
        $filter = new ReleaseGroupFilter();
        $filter->addNumberOfReleases(new Count(3));

        self::assertSame('releases:3', (string) $filter);
    }

    public function testFieldNamesThatDifferFromTheEntityName(): void
    {
        $place = new PlaceFilter();
        $place->addLatitude(new Latitude(58.388226));
        $place->addLongitude(new Longitude(26.702817));
        self::assertSame('lat:58.388226 AND long:26.702817', (string) $place);

        $area = new AreaFilter();
        $area->addIso31661Code(new ISO31661Code('DE'));
        self::assertSame('iso1:DE', (string) $area);

        $artist = new ArtistFilter();
        $artist->addEndAreaName(new Name('Berlin'));
        self::assertSame('endarea:"Berlin"', (string) $artist);
    }

    public function testAddMethodsChain(): void
    {
        $filter = new ReleaseFilter();

        $result = $filter->addASIN(new ASIN('B000003Z4N'))->addCatalogNumber(new CatalogNumber('PCS 7088'));

        self::assertSame($filter, $result);
        self::assertSame('asin:B000003Z4N AND catno:"PCS 7088"', (string) $filter);
    }

    public function testFormatsOfMediaCanBeSearchedFor(): void
    {
        $filter = new ReleaseFilter();
        $filter->addFormat(MediumFormatKind::Vinyl12);

        self::assertSame('format:"12\" Vinyl"', (string) $filter);
    }
}
