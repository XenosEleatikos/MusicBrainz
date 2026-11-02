<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Relation;

use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Value\Relation;
use MusicBrainz\Value\RelationList;
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
        $relation = Relation::tryFromArray(self::memberOfBand());

        self::assertInstanceOf(Relation::class, $relation);
        self::assertSame(EntityType::Artist, $relation->targetType);
        self::assertInstanceOf(Artist::class, $relation->target);
        self::assertSame('The Beatles', $relation->target->name);
        self::assertSame('backward', $relation->direction->value);
        self::assertSame('1960', (string) $relation->begin);
        self::assertSame('1970-04', (string) $relation->end);
        self::assertTrue($relation->ended);
        self::assertSame(['guitar'], $relation->attributes);
        self::assertSame(self::MEMBER_OF_BAND, (string) $relation->typeId);
        self::assertSame('member of band', $relation->typeName);
        self::assertSame('member of band', $relation->type::getRelationName());
        self::assertSame([], $this->logged);
    }

    public function testSearchResultsNameTheTargetOnTheOtherSideRegardlessOfTheDirection(): void
    {
        // "held at" is a relation of an event to a place; a search for events says "backward" and delivers the place
        $relation = Relation::tryFromArray([
            'type' => 'held at',
            'type-id' => 'e2c6f697-07dc-38b1-be0b-83d740165532',
            'direction' => 'backward',
            'place' => ['id' => 'db17e312-ec0a-4d8e-b2e4-bd00a7924588', 'name' => 'Wembley Stadium'],
        ]);

        self::assertNotNull($relation);
        self::assertSame(EntityType::Place, $relation->targetType);
        self::assertSame('Wembley Stadium', $relation->target->name);
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

    public function testUnknownRelationTypesAreKeptAndReported(): void
    {
        $list = RelationList::fromArray([self::memberOfBand(['type' => 'brand new', 'type-id' => '00000000-0000-4000-8000-000000000000'])]);

        self::assertCount(1, $list);
        $relation = $list->relations[0];
        self::assertNull($relation->type);
        self::assertSame('brand new', $relation->typeName);
        self::assertSame('The Beatles', $relation->target->name);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('Unknown relation type "brand new"', $this->logged[0]);
    }

    public function testRelationsWithoutValidDirectionAreSkippedAndReported(): void
    {
        self::assertNull(Relation::tryFromArray(self::memberOfBand(['direction' => 'sideways'])));
        self::assertNull(Relation::tryFromArray(self::memberOfBand(['direction' => null])));
        self::assertCount(2, $this->logged);
        self::assertStringContainsString('valid type id and direction', $this->logged[0]);
    }

    public function testRelationsWithoutTargetAreSkippedAndReported(): void
    {
        self::assertNull(Relation::tryFromArray(self::memberOfBand(['artist' => []])));
        self::assertStringContainsString('there is no target', $this->logged[0]);
    }

    public function testTheTargetTypeDecidesIfThereAreSeveralTargets(): void
    {
        $relation = Relation::tryFromArray(self::memberOfBand([
            'target-type' => 'artist',
            'place' => ['id' => 'db17e312-ec0a-4d8e-b2e4-bd00a7924588', 'name' => 'Wembley Stadium'],
        ]));

        self::assertNotNull($relation);
        self::assertSame(EntityType::Artist, $relation->targetType);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('more than one target', $this->logged[0]);
    }

    public function testAContradictingTargetTypeIsReported(): void
    {
        $relation = Relation::tryFromArray(self::memberOfBand(['target-type' => 'place']));

        self::assertNotNull($relation);
        self::assertSame(EntityType::Artist, $relation->targetType);
        self::assertCount(1, $this->logged);
        self::assertStringContainsString('target-type "place"', $this->logged[0]);
    }
}
