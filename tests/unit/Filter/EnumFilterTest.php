<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use MusicBrainz\Filter\Search\LabelFilter;
use MusicBrainz\Filter\Search\WorkFilter;
use MusicBrainz\Value\LabelTypeKind;
use MusicBrainz\Value\WorkTypeKind;
use PHPUnit\Framework\TestCase;

final class EnumFilterTest extends TestCase
{
    public function testValuesWithSeveralWordsCanBeSearchedFor(): void
    {
        // Used to throw an exception of the query builder: "Original Production" is no valid term
        $label = new LabelFilter();
        $label->addLabelType(LabelTypeKind::OriginalProduction);
        $work = new WorkFilter();
        $work->addWorkType(WorkTypeKind::AudioDrama);

        self::assertSame('type:"Original Production"', (string) $label);
        self::assertSame('type:"Audio drama"', (string) $work);
    }
}
