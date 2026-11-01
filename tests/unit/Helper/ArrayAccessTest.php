<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Helper;

use MusicBrainz\Config;
use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Test\Support\FakeHttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

final class ArrayAccessTest extends TestCase
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

    public function testReturnsValuesOfTheRequestedType(): void
    {
        $input = ['s' => 'text', 'i' => 4, 'f' => 1.5, 'b' => false, 'a' => [1]];

        self::assertSame('text', ArrayAccess::getString($input, 's'));
        self::assertSame(4, ArrayAccess::getInteger($input, 'i'));
        self::assertSame(1.5, ArrayAccess::getFloat($input, 'f'));
        self::assertFalse(ArrayAccess::getBool($input, 'b'));
        self::assertSame([1], ArrayAccess::getArray($input, 'a'));
        self::assertSame([], $this->logged);
    }

    public function testReturnsNullForMissingOrNullValuesWithoutComplaining(): void
    {
        $input = ['n' => null];

        self::assertNull(ArrayAccess::getString($input, 'n'));
        self::assertNull(ArrayAccess::getInteger($input, 'missing'));
        self::assertNull(ArrayAccess::getFloat($input, 'missing'));
        self::assertNull(ArrayAccess::getBool($input, 'missing'));
        self::assertNull(ArrayAccess::getArray($input, 'missing'));
        self::assertSame([], $this->logged);
    }

    public function testLogsAnErrorForValuesOfAnotherType(): void
    {
        $input = ['x' => 'text'];

        self::assertNull(ArrayAccess::getInteger($input, 'x'));
        self::assertNull(ArrayAccess::getBool($input, 'x'));
        self::assertNull(ArrayAccess::getArray($input, 'x'));
        self::assertNull(ArrayAccess::getFloat($input, 'x'));
        self::assertNull(ArrayAccess::getString(['x' => 1], 'x'));
        self::assertCount(5, $this->logged);
        self::assertStringContainsString('Unexpected API behavior', $this->logged[0]);
    }

    public function testConvertsNumbersWhereTheApiIsInconsistent(): void
    {
        // JSON does not distinguish 4 from 4.0, and the search API delivers numbers as strings
        self::assertSame(4.0, ArrayAccess::getFloat(['x' => 4], 'x'));
        self::assertSame(51.5, ArrayAccess::getFloat(['x' => '51.5'], 'x'));
        self::assertSame([], $this->logged);
    }
}
