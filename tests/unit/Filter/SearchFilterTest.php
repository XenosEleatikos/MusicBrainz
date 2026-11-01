<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use MusicBrainz\Filter\Search\ReleaseFilter;
use MusicBrainz\Filter\Search\ReleaseGroupFilter;
use MusicBrainz\Filter\Search\WorkFilter;
use MusicBrainz\Value\ASIN;
use MusicBrainz\Value\CatalogNumber;
use MusicBrainz\Value\Count;
use MusicBrainz\Value\ISWC;
use MusicBrainz\Value\MBID;
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

        self::assertSame('asin:B000003Z4N catno:"PCS 7088"', (string) $filter);
    }

    public function testWorkSearchFields(): void
    {
        $filter = new WorkFilter();
        $filter->addIswc(new ISWC('T-010.140.234-6'));
        $filter->addWorkId(new MBID('41c94a08-a551-3c86-bb17-d9a52e3a618b'));

        self::assertSame('iswc:T\-010.140.234\-6 wid:41c94a08\-a551\-3c86\-bb17\-d9a52e3a618b', (string) $filter);
    }

    public function testReleaseGroupSearchFields(): void
    {
        $filter = new ReleaseGroupFilter();
        $filter->addNumberOfReleases(new Count(3));

        self::assertSame('releases:3', (string) $filter);
    }
}
