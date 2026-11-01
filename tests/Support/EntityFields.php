<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use PHPUnit\Framework\Assert;

use function count;
use function is_array;

/**
 * Which JSON field of an entity is exposed by which getter of its value object.
 */
final class EntityFields
{
    /**
     * JSON key => getter, per entity type (as in the API path).
     */
    public const SCALARS = [
        'area'         => ['id' => 'getMBID', 'name' => 'getName', 'sort-name' => 'getSortName', 'disambiguation' => 'getDisambiguation'],
        'artist'       => ['id' => 'getMBID', 'name' => 'getArtistName', 'sort-name' => 'getSortName', 'disambiguation' => 'getDisambiguation', 'country' => 'getCountry'],
        'event'        => ['id' => 'getMBID', 'name' => 'getEventName', 'disambiguation' => 'getDisambiguation', 'time' => 'getTime'],
        'instrument'   => ['id' => 'getMBID', 'name' => 'getInstrumentName', 'disambiguation' => 'getDisambiguation', 'description' => 'getDescription'],
        'label'        => ['id' => 'getMBID', 'name' => 'getName', 'sort-name' => 'getSortName', 'disambiguation' => 'getDisambiguation', 'country' => 'getCountry'],
        'place'        => ['id' => 'getMBID', 'name' => 'getName', 'disambiguation' => 'getDisambiguation', 'address' => 'getAddress'],
        'recording'    => ['id' => 'getMBID', 'title' => 'getTitle', 'disambiguation' => 'getDisambiguation'],
        'release'      => ['id' => 'getMBID', 'title' => 'getTitle', 'disambiguation' => 'getDisambiguation', 'country' => 'getCountry', 'date' => 'getDate', 'barcode' => 'getBarcode', 'asin' => 'getAsin'],
        'release-group' => ['id' => 'getMBID', 'title' => 'getTitle', 'disambiguation' => 'getDisambiguation'],
        'series'       => ['id' => 'getMBID', 'name' => 'getName', 'disambiguation' => 'getDisambiguation'],
        'work'         => ['id' => 'getMBID', 'title' => 'getTitle', 'disambiguation' => 'getDisambiguation'],
    ];

    /**
     * The compare-and-assert for one entity: every scalar must be mirrored by its getter.
     *
     * @param array<string,mixed> $json
     */
    public static function assertMirrors(object $entity, string $type, array $json): void
    {
        foreach (self::SCALARS[$type] as $key => $getter) {
            $actual = $entity->$getter();
            if (isset($json[$key]) && '' !== $json[$key]) {
                \PHPUnit\Framework\Assert::assertSame((string) $json[$key], (string) $actual, "$getter() must return $key");
            } else {
                \PHPUnit\Framework\Assert::assertSame('', null === $actual ? '' : (string) $actual, "$getter() must be empty if $key is");
            }
        }
    }

    /**
     * Type-like fields: JSON key => [getter, key of the id].
     */
    private const TYPES = [
        'type'         => ['getArtistType', 'getAreaType', 'getLabelType', 'getEventType', 'getPlaceType', 'getInstrumentType', 'getSeriesType', 'getWorkType'],
    ];

    /**
     * Asserts the details beyond plain scalars: types, life span, aliases, tags, and for releases the nested structure.
     *
     * @param array<string,mixed> $json
     */
    public static function assertDetails(object $entity, array $json): void
    {
        foreach (self::TYPES['type'] as $getter) {
            if (method_exists($entity, $getter) && isset($json['type'])) {
                $type = $entity->$getter();
                Assert::assertSame($json['type'], $type->name, "$getter() must keep the name");
                Assert::assertSame($json['type-id'] ?? null, null === $type->id ? null : (string) $type->id);
                // Known values must be resolved to a case (otherwise the library logged a problem, checked by callers)
                Assert::assertNotNull($type->kind(), "$getter() of {$json['type']} must be a known kind");
            }
        }

        if (method_exists($entity, 'getGender') && isset($json['gender'])) {
            Assert::assertSame($json['gender'], $entity->getGender()->name);
            Assert::assertNotNull($entity->getGender()->kind());
        }

        if (method_exists($entity, 'getLifeSpan') && isset($json['life-span'])) {
            $lifeSpan = $entity->getLifeSpan();
            Assert::assertSame($json['life-span']['begin'] ?? '', (string) $lifeSpan->getBeginDate());
            Assert::assertSame($json['life-span']['end'] ?? '', (string) $lifeSpan->getEndDate());
            Assert::assertSame($json['life-span']['ended'] ?? false, $lifeSpan->getEnded()->isEnded());
        }

        foreach (['area' => 'getArea', 'begin-area' => 'getBeginArea', 'end-area' => 'getEndArea'] as $key => $getter) {
            if (method_exists($entity, $getter) && isset($json[$key]) && is_array($json[$key])) {
                self::assertMirrors($entity->$getter(), 'area', $json[$key]);
            }
        }

        if (method_exists($entity, 'getAliases') && isset($json['aliases'])) {
            foreach ($json['aliases'] as $index => $aliasJson) {
                $alias = $entity->getAliases()[$index];
                Assert::assertSame($aliasJson['name'], (string) $alias->getName());
                Assert::assertSame($aliasJson['sort-name'], (string) $alias->getSortName());
                Assert::assertSame($aliasJson['primary'] ?? false, $alias->getPrimaryName()->isPrimaryName());
                if (isset($aliasJson['type'])) {
                    Assert::assertSame($aliasJson['type'], $alias->getAliasType()->name);
                    Assert::assertNotNull($alias->getAliasType()->kind());
                }
            }
        }

        if (method_exists($entity, 'getTags') && isset($json['tags'])) {
            foreach ($json['tags'] as $index => $tagJson) {
                Assert::assertSame($tagJson['name'], (string) $entity->getTags()[$index]->getName());
                Assert::assertSame($tagJson['count'], $entity->getTags()[$index]->getCount()->getNumber());
            }
        }
    }

    /**
     * Asserts the nested structure of releases, release groups and recordings.
     *
     * @param array<string,mixed> $json
     */
    public static function assertStructure(object $entity, array $json): void
    {
        if (isset($json['artist-credit']) && method_exists($entity, 'getArtistCredits')) {
            self::assertArtistCredits($entity->getArtistCredits(), $json['artist-credit']);
        }

        if ($entity instanceof \MusicBrainz\Value\ReleaseGroup) {
            if (isset($json['primary-type'])) {
                Assert::assertSame($json['primary-type'], $entity->getPrimaryReleaseType()->name);
                Assert::assertNotNull($entity->getPrimaryReleaseType()->kind());
            }
            Assert::assertCount(count($json['secondary-types'] ?? []), $entity->getSecondaryReleaseTypes());
            foreach ($json['secondary-types'] ?? [] as $index => $name) {
                Assert::assertSame($name, $entity->getSecondaryReleaseTypes()[$index]->name);
                Assert::assertNotNull($entity->getSecondaryReleaseTypes()[$index]->kind());
            }
        }

        if ($entity instanceof \MusicBrainz\Value\Release) {
            foreach (['status' => 'getReleaseStatus', 'packaging' => 'getPackaging'] as $key => $getter) {
                if (isset($json[$key])) {
                    Assert::assertSame($json[$key], $entity->$getter()->name);
                    Assert::assertSame($json[$key . '-id'] ?? null, null === $entity->$getter()->id ? null : (string) $entity->$getter()->id);
                    Assert::assertNotNull($entity->$getter()->kind());
                }
            }
            if (isset($json['quality'])) {
                Assert::assertSame($json['quality'], $entity->getQuality()?->value);
            }
            if (isset($json['text-representation'])) {
                Assert::assertSame($json['text-representation']['language'] ?? '', (string) $entity->getTextRepresentation()->getLanguage());
                Assert::assertSame($json['text-representation']['script'] ?? '', (string) $entity->getTextRepresentation()->getScript());
            }
            if (isset($json['release-group'])) {
                self::assertMirrors($entity->getReleaseGroup(), 'release-group', $json['release-group']);
                self::assertStructure($entity->getReleaseGroup(), $json['release-group']);
            }
            Assert::assertCount(count($json['release-events'] ?? []), $entity->getReleaseEvents());
            foreach ($json['release-events'] ?? [] as $index => $eventJson) {
                $event = $entity->getReleaseEvents()[$index];
                Assert::assertSame($eventJson['date'] ?? '', (string) $event->getDate());
                if (isset($eventJson['area'])) {
                    self::assertMirrors($event->getArea(), 'area', $eventJson['area']);
                }
            }
            Assert::assertCount(count($json['label-info'] ?? []), $entity->getLabelInfos());
            foreach ($json['label-info'] ?? [] as $index => $infoJson) {
                $info = $entity->getLabelInfos()[$index];
                Assert::assertSame($infoJson['catalog-number'] ?? '', (string) $info->getCatalogueNumber());
                if (isset($infoJson['label'])) {
                    self::assertMirrors($info->getLabel(), 'label', $infoJson['label']);
                }
            }
            Assert::assertCount(count($json['media'] ?? []), $entity->getMedia());
            foreach ($json['media'] ?? [] as $index => $mediumJson) {
                $medium = $entity->getMedia()[$index];
                Assert::assertSame($mediumJson['title'] ?? '', (string) $medium->getTitle());
                Assert::assertSame($mediumJson['format'] ?? '', (string) $medium->getFormat());
                Assert::assertSame($mediumJson['format-id'] ?? '', (string) $medium->getFormat()->getMBID());
                Assert::assertCount(count($mediumJson['discs'] ?? []), $medium->getDiscs());
                foreach ($mediumJson['discs'] ?? [] as $d => $discJson) {
                    Assert::assertSame($discJson['id'], (string) $medium->getDiscs()[$d]->getDiscId());
                    Assert::assertSame((string) $discJson["sectors"], (string) $medium->getDiscs()[$d]->getSectors());
                    Assert::assertCount(count($discJson['offsets']), $medium->getDiscs()[$d]->getSectorOffsets());
                }
                Assert::assertCount(count($mediumJson['tracks'] ?? []), $medium->getTracks());
                foreach ($mediumJson['tracks'] ?? [] as $t => $trackJson) {
                    $track = $medium->getTracks()[$t];
                    Assert::assertSame($trackJson['id'], (string) $track->getMBID());
                    Assert::assertSame($trackJson['title'], (string) $track->getTitle());
                    Assert::assertSame($trackJson['number'], (string) $track->getTrackDisplayNumber());
                    if (isset($trackJson['artist-credit'])) {
                        self::assertArtistCredits($track->getArtistCredits(), $trackJson['artist-credit']);
                    }
                }
            }
        }
    }

    /**
     * @param array<int,array<string,mixed>> $json
     */
    private static function assertArtistCredits(object $credits, array $json): void
    {
        Assert::assertCount(count($json), $credits);
        foreach ($json as $index => $creditJson) {
            $credit = $credits[$index];
            Assert::assertSame($creditJson['name'] ?? '', (string) $credit->getName());
            Assert::assertSame($creditJson['joinphrase'] ?? '', (string) $credit->getJoinPhrase());
            self::assertMirrors($credit->getArtist(), 'artist', $creditJson['artist']);
        }
    }
}
