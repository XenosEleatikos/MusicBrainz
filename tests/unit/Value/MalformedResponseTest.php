<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Test\Support\FakeHttpClient;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\Page;
use MusicBrainz\Value\Release;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

/**
 * A surprise in a response of the web service must show up in the log, and must not spoil the rest of the response.
 */
final class MalformedResponseTest extends TestCase
{
    /** @var list<string> */
    private array $logged = [];

    protected function setUp(): void
    {
        $this->logged = [];
        $logger = new class ($this->logged) extends AbstractLogger {
            /** @param list<string> $messages */
            public function __construct(private array &$messages) {}

            public function log($level, string|Stringable $message, array $context = []): void
            {
                $this->messages[] = "[$level] $message";
            }
        };
        new MusicBrainz(new FakeHttpClient(), new Psr17Factory(), $logger, new Config());
    }

    public function testAnInvalidIdIsLoggedAndTheRestIsKept(): void
    {
        $artist = Artist::fromArray(['id' => 'abc', 'name' => 'The Beatles', 'type' => 'Group', 'type-id' => 'x']);

        self::assertNull($artist->id);
        self::assertSame('The Beatles', $artist->name);
        self::assertSame('Group', $artist->type?->name);
        self::assertNull($artist->type->id);
        self::assertCount(2, $this->logged);
        self::assertStringContainsString('"abc" in "id" is not an MBID', $this->logged[0]);
    }

    public function testAnUnexpectedDateIsLoggedAndTheRestIsKept(): void
    {
        $release = Release::fromArray(['id' => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', 'title' => 'Abbey Road', 'date' => '1969-13']);

        self::assertNull($release->date);
        self::assertSame('Abbey Road', $release->title);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('[warning]', $this->logged[0]);
    }

    public function testElementsOfTheWrongTypeAreLoggedAndSkipped(): void
    {
        $artist = Artist::fromArray(['id' => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', 'name' => 'x', 'aliases' => ['oops', ['name' => 'Fab Four']]]);

        self::assertCount(1, $artist->aliases);
        self::assertSame('Fab Four', $artist->aliases[0]->name);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('an element of "aliases" is of type string', $this->logged[0]);
    }

    public function testAMissingListIsNotAnEmptyResultInSilence(): void
    {
        $page = Page::browse(['artist-count' => 3, 'artist-offset' => 0, 'artistes' => []], 'artist', Artist::class);

        self::assertCount(0, $page);
        self::assertSame(3, $page->totalCount);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('has no list "artists"', $this->logged[0]);
    }

    public function testAnUnexpectedCountIsLogged(): void
    {
        $page = Page::browse(['artists' => [], 'artist-count' => '3', 'artist-offset' => 0], 'artist', Artist::class);

        self::assertSame(0, $page->totalCount);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('"artist-count" is missing or not an integer', $this->logged[0]);
    }

    public function testRelationsGivenAsObjectInsteadOfListDoNotCrash(): void
    {
        $artist = Artist::fromArray(['id' => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', 'name' => 'x', 'relation-list' => [['relations' => ['a' => 'b']]]]);

        self::assertNotNull($artist->relations);
        self::assertCount(0, $artist->relations);
    }
}
