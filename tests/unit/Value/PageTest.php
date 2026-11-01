<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use LogicException;
use MusicBrainz\Value\Page;
use MusicBrainz\Value\Tag;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;

final class PageTest extends TestCase
{
    public function testAPageIsReadOnly(): void
    {
        $page = new Page([new Tag('rock', 3)], 10, 5);

        self::assertCount(1, $page);
        self::assertSame(10, $page->totalCount);
        self::assertSame('rock', $page[0]->name);
        self::assertTrue(isset($page[0]));
        self::assertFalse(isset($page[1]));

        $this->expectException(LogicException::class);
        $page[0] = new Tag('pop');
    }

    public function testAnElementThatIsNotThereIsAnError(): void
    {
        $this->expectException(OutOfRangeException::class);

        (new Page([], 0))[0];
    }
}
