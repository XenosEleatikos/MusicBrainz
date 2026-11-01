<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\MusicBrainz;
use MusicBrainz\Test\Support\FakeHttpClient;
use MusicBrainz\Value\ReleaseStatus;
use MusicBrainz\Value\ReleaseStatusKind;
use MusicBrainz\Value\ReleaseGroup;
use MusicBrainz\Value\SecondaryReleaseTypeKind;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

class NamedTypeTest extends TestCase
{
    /** @var list<array{level: string, message: string}> */
    private array $logs = [];

    protected function setUp(): void
    {
        $this->logs = [];
        $logs = &$this->logs;
        $logger = new class ($logs) extends AbstractLogger {
            public function __construct(private array &$logs) {}

            public function log($level, string|Stringable $message, array $context = []): void
            {
                $this->logs[] = ['level' => (string) $level, 'message' => (string) $message];
            }
        };
        new MusicBrainz(new FakeHttpClient(), new Psr17Factory(), $logger);
    }

    /**
     * @return array<string, array{string, ReleaseStatusKind}>
     */
    public static function knownStatuses(): array
    {
        $cases = [];
        foreach (ReleaseStatusKind::cases() as $case) {
            $cases[$case->value] = [$case->value, $case];
        }

        return $cases;
    }

    #[DataProvider('knownStatuses')]
    public function testKnownValueIsResolvedWithoutLogging(string $name, ReleaseStatusKind $expected): void
    {
        $status = ReleaseStatus::make($name, '4e304316-386d-3409-af2e-78857eec5cfe');

        self::assertSame($expected, $status->kind());
        self::assertSame($name, (string) $status);
        self::assertSame('4e304316-386d-3409-af2e-78857eec5cfe', (string) $status->id);
        self::assertSame([], $this->logs);
    }

    public function testUnknownValueIsKeptAndLogged(): void
    {
        $status = ReleaseStatus::make('Brand New Status', 'a8bd2f09-6d60-4ee9-b0a1-4ed0d6fcc3f3');

        self::assertNull($status->kind());
        self::assertSame('Brand New Status', $status->name);
        self::assertSame('a8bd2f09-6d60-4ee9-b0a1-4ed0d6fcc3f3', (string) $status->id);
        self::assertCount(1, $this->logs);
        self::assertSame('warning', $this->logs[0]['level']);
        self::assertStringContainsString('Brand New Status', $this->logs[0]['message']);
    }

    public function testKindIsResolvedCaseInsensitively(): void
    {
        $status = ReleaseStatus::make('official');

        self::assertSame(ReleaseStatusKind::Official, $status->kind());
        self::assertSame('official', $status->name);
        self::assertSame([], $this->logs);
    }

    public function testFromArrayWithoutNameReturnsNull(): void
    {
        self::assertNull(ReleaseStatus::fromArray(['status-id' => 'x'], 'status', 'status-id'));
        self::assertSame([], $this->logs);
    }

    public function testSecondaryTypesOfAReleaseGroupPairNamesWithIds(): void
    {
        $releaseGroup = ReleaseGroup::fromArray([
            'id' => 'ed4bb6ce-ace6-3841-931b-7f8f0bcfe806',
            'secondary-types' => ['Live', 'DJ-mix'],
            'secondary-type-ids' => ['6fd474e2-6b58-3102-9d17-d6f7eb7da0a0', '4ffb3c4f-e2fe-3c8d-9c1b-0d7c1d1d5b6e'],
        ]);

        self::assertCount(2, $releaseGroup->secondaryTypes);
        self::assertSame(SecondaryReleaseTypeKind::Live, $releaseGroup->secondaryTypes[0]->kind());
        self::assertSame(SecondaryReleaseTypeKind::DjMix, $releaseGroup->secondaryTypes[1]->kind());
        self::assertSame('4ffb3c4f-e2fe-3c8d-9c1b-0d7c1d1d5b6e', (string) $releaseGroup->secondaryTypes[1]->id);
    }
}
