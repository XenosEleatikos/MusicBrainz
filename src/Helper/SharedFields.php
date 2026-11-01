<?php

declare(strict_types=1);

namespace MusicBrainz\Helper;

use MusicBrainz\Relation\RelationList;
use MusicBrainz\Value\Alias;
use MusicBrainz\Value\Genre;
use MusicBrainz\Value\Rating;
use MusicBrainz\Value\Tag;

use function array_push;
use function is_array;

/**
 * The fields almost all entities share: aliases, tags, genres, ratings, annotation and relations, including those of
 * the authenticated user. Returns them as named arguments for the constructor of an entity.
 *
 * @internal
 */
final class SharedFields
{
    /**
     * @param array<mixed> $data A decoded entity
     *
     * @return array{
     *     aliases: list<Alias>,
     *     tags: list<Tag>,
     *     genres: list<Genre>,
     *     userTags: list<Tag>,
     *     userGenres: list<Genre>,
     *     rating: null|Rating,
     *     userRating: null|int,
     *     annotation: null|string,
     *     relations: null|RelationList,
     * }
     */
    public static function parse(array $data): array
    {
        $rating = ArrayAccess::getArray($data, 'rating');
        $userRating = ArrayAccess::getArray($data, 'user-rating');

        return [
            'aliases'    => Json::list($data, 'aliases', Alias::class),
            'tags'       => Json::list($data, 'tags', Tag::class),
            'genres'     => Json::list($data, 'genres', Genre::class),
            'userTags'   => Json::list($data, 'user-tags', Tag::class),
            'userGenres' => Json::list($data, 'user-genres', Genre::class),
            'rating'     => null === $rating || [] === $rating || !isset($rating['value']) ? null : Rating::fromArray($rating),
            'userRating' => null === $userRating ? null : ArrayAccess::getInteger($userRating, 'value'),
            'annotation' => ArrayAccess::getString($data, 'annotation'),
            'relations'  => self::relations($data),
        ];
    }

    /**
     * @param array<mixed> $data
     */
    private static function relations(array $data): ?RelationList
    {
        $relations = ArrayAccess::getArray($data, 'relations');
        if (null !== $relations) {
            return RelationList::fromArray($relations);
        }

        // Search results deliver relations as "relation-list": [{"relations": [...]}]
        $lists = ArrayAccess::getArray($data, 'relation-list');
        if (null === $lists) {
            return null;
        }
        $merged = [];
        foreach ($lists as $list) {
            if (is_array($list) && is_array($list['relations'] ?? null)) {
                array_push($merged, ...$list['relations']);
            }
        }

        return RelationList::fromArray($merged);
    }
}
