<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Value\Alias;
use MusicBrainz\Value\Collection;
use MusicBrainz\Value\Genre;
use MusicBrainz\Value\Tag;
use PHPUnit\Framework\TestCase;

final class ToStringTest extends TestCase
{
    public function testNamedResultsPrintTheirName(): void
    {
        self::assertSame('Fab Four', (string) Alias::fromArray(['name' => 'Fab Four']));
        self::assertSame('rock', (string) Tag::fromArray(['name' => 'rock', 'count' => 3]));
        self::assertSame('pop', (string) Genre::fromArray(['name' => 'pop', 'count' => 1]));
        self::assertSame('My favourites', (string) Collection::fromArray(['id' => 'f27d2f80-0aff-4a0f-a8c3-296226073b20', 'name' => 'My favourites']));
    }
}
