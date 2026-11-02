<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Value\Medium;
use MusicBrainz\Value\MediumFormatKind;
use PHPUnit\Framework\TestCase;

final class MediumTest extends TestCase
{
    public function testPregapAndDataTracksOfAnEnhancedCd(): void
    {
        $medium = Medium::fromArray([
            'position' => 1,
            'format' => 'Enhanced CD',
            'format-id' => null,
            'track-count' => 2,
            'pregap' => ['id' => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', 'title' => 'Hidden', 'number' => '0', 'position' => 0, 'length' => 1000],
            'tracks' => [['id' => 'a74b1b7f-71a5-4011-9441-d0b5e4122711', 'title' => 'First', 'number' => '1', 'position' => 1, 'length' => 2000]],
            'data-tracks' => [['id' => '5441c29d-3602-4898-b1a1-b77fa23b8e50', 'title' => 'Video', 'number' => 'D1', 'position' => 1]],
        ]);

        self::assertSame(MediumFormatKind::EnhancedCd, $medium->format?->kind());
        self::assertSame('Hidden', $medium->pregap?->title);
        self::assertCount(1, $medium->tracks);
        self::assertCount(1, $medium->dataTracks);
        self::assertSame('D1', $medium->dataTracks[0]->number);
    }

    public function testAMediumWithoutThemHasNone(): void
    {
        $medium = Medium::fromArray(['position' => 1]);

        self::assertNull($medium->pregap);
        self::assertSame([], $medium->dataTracks);
    }

    public function testFormatsThatTheWebServiceDeliversTodayAreKnown(): void
    {
        // Names confirmed with the web service: the search for a format returns releases with exactly this name
        foreach (['Microcassette' => MediumFormatKind::Microcassette, 'SD Card' => MediumFormatKind::SdCard, 'DualDisc (CD side)' => MediumFormatKind::DualDiscCdSide,
            '12" Acetate' => MediumFormatKind::Acetate12, 'Hybrid SACD (CD layer)' => MediumFormatKind::HybridSacdCdLayer] as $name => $kind) {
            self::assertSame($kind, Medium::fromArray(['format' => $name])->format?->kind(), $name);
        }
    }
}
