<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Exception;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\Value\MBID;
use PHPUnit\Framework\TestCase;

final class MBIDTest extends TestCase
{
    public function testAcceptsAUuid(): void
    {
        self::assertSame('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', (string) new MBID('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d'));
        self::assertSame('B10BBBFC-CF9E-42E0-BE17-E2C3E1D2600D', (string) new MBID('B10BBBFC-CF9E-42E0-BE17-E2C3E1D2600D'));
    }

    public function testRefusesAnythingElse(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"typo" is not a valid MusicBrainz Identifier');

        new MBID('typo');
    }

    public function testTheExceptionIsAMusicBrainzException(): void
    {
        $this->expectException(Exception::class);

        new MBID('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600');
    }

    public function testAbsentValuesAreEmpty(): void
    {
        self::assertSame('', (string) new MBID());
        self::assertSame('', (string) new MBID(null));
    }
}
