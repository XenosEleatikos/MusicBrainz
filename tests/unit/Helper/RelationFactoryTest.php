<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Helper;

use MusicBrainz\Config;
use MusicBrainz\Helper\RelationFactory;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Relation\Target\RelationToArtist;
use MusicBrainz\Test\Support\FakeHttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

final class RelationFactoryTest extends TestCase
{
    private const MEMBER_OF_BAND = '5be4c609-9afa-4ea0-910b-12ffb71e3821';

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

    /**
     * @return array<string,mixed>
     */
    private static function memberOfBand(array $override = []): array
    {
        return $override + [
            'type' => 'member of band',
            'type-id' => self::MEMBER_OF_BAND,
            'direction' => 'backward',
            'target-type' => 'artist',
            'attributes' => ['guitar'],
            'attribute-ids' => ['guitar' => 'b3eac5f9-7859-4416-ac39-7154e2e8d348'],
            'begin' => '1960',
            'end' => '1970-04',
            'ended' => true,
            'artist' => ['id' => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', 'name' => 'The Beatles', 'sort-name' => 'Beatles, The'],
        ];
    }

    public function testSortsRelationsByTargetEntityAndKeepsTheirOwnData(): void
    {
        $relations = RelationFactory::makeRelations([self::memberOfBand()]);

        self::assertSame(['artist'], array_keys($relations));
        $relation = $relations['artist'][0];
        self::assertInstanceOf(RelationToArtist::class, $relation);
        self::assertSame('The Beatles', (string) $relation->getArtist()->getArtistName());
        self::assertSame('backward', $relation->getDirection()->value);
        self::assertSame('1960', (string) $relation->getBeginDate());
        self::assertSame('1970-04', (string) $relation->getEndDate());
        self::assertTrue($relation->isEnded());
        self::assertSame(['guitar'], $relation->getAttributes());
        self::assertSame([], $this->logged);
    }

    public function testSkipsAndReportsUnknownRelationTypes(): void
    {
        $relations = RelationFactory::makeRelations([self::memberOfBand(['type-id' => '00000000-0000-4000-8000-000000000000'])]);

        self::assertSame([], $relations);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('Unknown relation type', $this->logged[0]);
    }

    public function testSkipsAndReportsRelationsWithoutValidDirection(): void
    {
        self::assertSame([], RelationFactory::makeRelations([self::memberOfBand(['direction' => 'sideways'])]));
        self::assertSame([], RelationFactory::makeRelations([self::memberOfBand(['direction' => null])]));
        self::assertCount(2, $this->logged);
        self::assertStringContainsString('valid direction', $this->logged[0]);
    }

    public function testSkipsAndReportsRelationsWithoutTarget(): void
    {
        self::assertSame([], RelationFactory::makeRelations([self::memberOfBand(['artist' => []])]));
        self::assertStringContainsString('Cannot resolve relation', $this->logged[0]);
    }
}
