<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Relation;

use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Relation;
use MusicBrainz\Relation\RelationList;
use MusicBrainz\Test\Support\FakeHttpClient;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\EntityType;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

final class RelationTest extends TestCase
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
     * @param array<string,mixed> $override
     *
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

    public function testRelationKnowsItsTargetAndItsOwnData(): void
    {
        $relation = Relation::fromArray(self::memberOfBand());

        self::assertInstanceOf(Relation::class, $relation);
        self::assertSame(EntityType::Artist, $relation->targetType);
        self::assertInstanceOf(Artist::class, $relation->target);
        self::assertSame('The Beatles', $relation->target->name);
        self::assertSame('backward', $relation->direction->value);
        self::assertSame('1960', (string) $relation->begin);
        self::assertSame('1970-04', (string) $relation->end);
        self::assertTrue($relation->ended);
        self::assertSame(['guitar'], $relation->attributes);
        self::assertSame(self::MEMBER_OF_BAND, (string) $relation->type::getRelationTypeId());
        self::assertSame([], $this->logged);
    }

    public function testRelationListGroupsByTargetType(): void
    {
        $list = RelationList::fromArray([self::memberOfBand(), self::memberOfBand(['artist' => ['id' => 'a74b1b7f-71a5-4011-9441-d0b5e4122711', 'name' => 'Radiohead']])]);

        self::assertCount(2, $list);
        self::assertCount(2, $list->to(EntityType::Artist));
        self::assertSame([], $list->to(EntityType::Label));
        self::assertSame('Radiohead', $list->to(EntityType::Artist)[1]->target->name);
    }

    public function testUnknownRelationTypesAreSkippedAndReported(): void
    {
        $list = RelationList::fromArray([self::memberOfBand(['type-id' => '00000000-0000-4000-8000-000000000000'])]);

        self::assertCount(0, $list);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('Unknown relation type', $this->logged[0]);
    }

    public function testRelationsWithoutValidDirectionAreSkippedAndReported(): void
    {
        self::assertNull(Relation::fromArray(self::memberOfBand(['direction' => 'sideways'])));
        self::assertNull(Relation::fromArray(self::memberOfBand(['direction' => null])));
        self::assertCount(2, $this->logged);
        self::assertStringContainsString('valid direction', $this->logged[0]);
    }

    public function testRelationsWithoutTargetAreSkippedAndReported(): void
    {
        self::assertNull(Relation::fromArray(self::memberOfBand(['artist' => []])));
        self::assertStringContainsString('Cannot resolve relation', $this->logged[0]);
    }
}
