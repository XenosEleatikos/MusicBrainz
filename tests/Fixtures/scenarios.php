<?php

declare(strict_types=1);

/**
 * Scenarios for bin/record-fixtures: each one performs a request with the library against the live MusicBrainz web
 * service. Popular, well maintained entities are used wherever possible; a few sparse ones cover empty/null cases.
 *
 * The response of every request is stored as fixture, see tests/Fixtures/recorded.
 */

use MusicBrainz\Filter\Browse\Relation\Entity\AreaRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ArtistRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\CollectionRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\EventRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\InstrumentRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\LabelRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\RecordingRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\SeriesRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\WorkRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Browse\Relation\Entity\PlaceRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseGroupRelation;
use MusicBrainz\Filter\Search\AnnotationFilter;
use MusicBrainz\Filter\Search\AreaFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Filter\Search\CdStubFilter;
use MusicBrainz\Filter\Search\LabelFilter;
use MusicBrainz\Filter\Search\PlaceFilter;
use MusicBrainz\Filter\Search\RecordingFilter;
use MusicBrainz\Filter\Search\ReleaseFilter;
use MusicBrainz\Filter\Search\ReleaseGroupFilter;
use MusicBrainz\Filter\Search\TagFilter;
use MusicBrainz\Filter\Search\WorkFilter;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Supplement\Browse;
use MusicBrainz\Supplement\Fields;
use MusicBrainz\Supplement\Lookup;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Name;
use MusicBrainz\Value\Title;

/** Enables every include flag except the ones requiring authentication (user-*). */
$full = static function (Fields $fields): Fields {
    foreach (get_class_methods($fields) as $method) {
        if (str_starts_with($method, 'include') && !str_contains($method, 'User')) {
            $fields->$method();
        }
    }

    return $fields;
};

$mbid = static fn(string $id): MBID => new MBID($id);
/** Creates a browse filter: relation($class, 'artist', <mbid>) */
$relation = static function (string $class, string $method, string $id): object {
    $relation = new $class();
    $relation->$method(new MBID($id));

    return $relation;
};
$page = static fn(int $limit = 25, int $offset = 0): PageFilter => new PageFilter($offset, $limit);

$scenarios = [];

// ---------------------------------------------------------------------------------------------------- lookups
$lookups = [
    'area'         => ['germany' => '85752fda-13c4-31a3-bee5-0e5cb1f51dad', 'london' => 'f03d09b3-39dc-4083-afd6-159e3f0d462f'],
    'artist'       => [
        'beatles'   => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d',
        'radiohead' => 'a74b1b7f-71a5-4011-9441-d0b5e4122711',
        'bowie'     => '5441c29d-3602-4898-b1a1-b77fa23b8e50',
        'bjork'     => '87c5dedd-371d-4a53-9f7f-80522fb7f3cb',
        'daft-punk' => '056e4f3e-d505-4dad-8ec1-d04f521cbb56',
        'bach'      => '24f1766e-9635-4d58-a4d4-9413f9f98a4c',
        'miles'     => '561d854a-6a28-4aa7-8c99-323e6ce46c2a',
    ],
    'event'        => ['live-aid-wembley' => '8e0ff16a-757f-4e16-9877-4c4131621a8b', 'live-aid-jfk' => 'e4ea9ddd-3fbb-47d0-b570-add507bf0c27'],
    'instrument'   => ['piano' => 'b3eac5f9-7859-4416-ac39-7154e2e8d348'],
    'label'        => ['parlophone' => 'df7d1c7f-ef95-425f-8eef-445b3d7bcbd9', 'blue-note' => '713c4a95-6616-442b-9cf6-14e1ddfd5946'],
    'place'        => ['abbey-road' => 'bd55aeb7-19d1-4607-a500-14b8479d3fed'],
    'recording'    => ['bohemian-rhapsody-live-aid' => '106d1527-d378-4e55-ba49-d18f8e63ae8a'],
    'release'      => ['abbey-road' => '31765b9f-e969-4257-855f-c7ea1f657b2a', 'abbey-road-anniversary' => '8c6a00d5-8673-4aad-8192-5fe8649b5efa'],
    'releaseGroup' => ['abbey-road' => '9162580e-5df4-32de-80cc-f45a8d8a9b1d', 'ok-computer' => 'b1392450-e666-3926-a536-22c65f834433'],
    'series'       => ['beethoven-symphonies' => 'c91a484c-b9f5-4842-a39f-906c4bfc9c7e'],
    'work'         => ['bohemian-rhapsody' => '41c94a08-a551-3c86-bb17-d9a52e3a618b'],
];

// Less popular, sparsely maintained entities (taken from search results): missing and empty fields must not break parsing
$lookups['area']['london-sparse']                  = '7bfa293f-d942-46f4-8f95-0a205faa5d2d';
$lookups['artist']['jon-bjork-sparse']             = '6a276be8-dc5d-44bc-8de8-aba5201fcf60';
$lookups['artist']['xanthe-waite-sparse']          = 'b856b4ae-5c73-4476-a61c-f1fddc573a4e';
$lookups['label']['parlophone-norway-sparse']      = '01ad5e97-2bb6-451b-b0c5-02dc3fa90b03';
$lookups['release']['abbey-road-sparse']           = 'b25a1e5d-3247-41ea-9920-f93c58a6e479';
$lookups['recording']['bohemian-rhapsody-sparse']  = '79d660ef-dd32-4c5c-b2aa-a9d736cd2396';
$lookups['releaseGroup']['alexa-play-ok-computer'] = '6c5a2f5b-8959-4e8e-8342-78b3e9ff72ce';
$lookups['work']['bohemian-rhapsody-sparse']       = 'a8f4f093-823a-4cc0-86e7-76c784dbd65b';

$lookups['url'] = ['wikidata-beatles' => '7a14a19d-17d6-452e-8741-6ace4eea275c', 'discogs-beatles' => '4327d342-5545-4168-a4c9-f8a740099d5d'];

foreach ($lookups as $entity => $entities) {
    $fieldsClass = 'MusicBrainz\\Supplement\\Lookup\\' . ucfirst($entity) . 'Fields';
    foreach ($entities as $label => $id) {
        $scenarios["lookup/$entity/$label/minimal"] = static fn(MusicBrainz $mb) => $mb->api()->lookup()->$entity($mbid($id), new $fieldsClass());
        $scenarios["lookup/$entity/$label/full"]    = static fn(MusicBrainz $mb) => $mb->api()->lookup()->$entity($mbid($id), $full(new $fieldsClass()));
    }
}

// ---------------------------------------------------------------------------------------------------- browse
$beatles = 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d';
$radiohead = 'a74b1b7f-71a5-4011-9441-d0b5e4122711';
$bach = '24f1766e-9635-4d58-a4d4-9413f9f98a4c';

$scenarios['browse/release/by-artist-beatles']        = static fn(MusicBrainz $mb) => $mb->api()->browse()->release($relation(ReleaseRelation::class, 'artist', $beatles), $full(new Browse\ReleaseFields()), $page(25));
$scenarios['browse/release/by-artist-beatles/page-2'] = static fn(MusicBrainz $mb) => $mb->api()->browse()->release($relation(ReleaseRelation::class, 'artist', $beatles), $full(new Browse\ReleaseFields()), $page(25, 25));
$scenarios['browse/release/by-label-parlophone']      = static fn(MusicBrainz $mb) => $mb->api()->browse()->release($relation(ReleaseRelation::class, 'label', 'df7d1c7f-ef95-425f-8eef-445b3d7bcbd9'), $full(new Browse\ReleaseFields()), $page(10));
$scenarios['browse/recording/by-artist-radiohead']    = static fn(MusicBrainz $mb) => $mb->api()->browse()->recording($relation(RecordingRelation::class, 'artist', $radiohead), $full(new Browse\RecordingFields()), $page(25));
$scenarios['browse/work/by-artist-bach']              = static fn(MusicBrainz $mb) => $mb->api()->browse()->work($relation(WorkRelation::class, 'artist', $bach), $full(new Browse\WorkFields()), $page(25));
$scenarios['browse/event/by-artist-radiohead']        = static fn(MusicBrainz $mb) => $mb->api()->browse()->event($relation(EventRelation::class, 'artist', $radiohead), $full(new Browse\EventFields()), $page(10));
$scenarios['browse/artist/by-area-germany']           = static fn(MusicBrainz $mb) => $mb->api()->browse()->artist($relation(ArtistRelation::class, 'area', '85752fda-13c4-31a3-bee5-0e5cb1f51dad'), $full(new Browse\ArtistFields()), $page(10));
$scenarios['browse/label/by-area-germany']            = static fn(MusicBrainz $mb) => $mb->api()->browse()->label($relation(LabelRelation::class, 'area', '85752fda-13c4-31a3-bee5-0e5cb1f51dad'), $full(new Browse\LabelFields()), $page(10));

// ---------------------------------------------------------------------------------------------------- search
$scenarios['search/artist/beatles'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new ArtistFilter();
    $filter->addArtistNameWithoutAccents(new Name('The Beatles'));

    return $mb->api()->search()->artist($filter, $page(5));
};
$scenarios['search/artist/bjork-accents'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new ArtistFilter();
    $filter->addArtistNameWithoutAccents(new Name('Björk'));

    return $mb->api()->search()->artist($filter, $page(5));
};
$scenarios['search/area/london'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new AreaFilter();
    $filter->addAreaName(new Name('London'));

    return $mb->api()->search()->area($filter, $page(5));
};
$scenarios['search/label/parlophone'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new LabelFilter();
    $filter->addLabelNameWithoutAccents(new Name('Parlophone'));

    return $mb->api()->search()->label($filter, $page(5));
};
$scenarios['search/release/abbey-road'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new ReleaseFilter();
    $filter->addReleaseName(new Name('Abbey Road'));

    return $mb->api()->search()->release($filter, $page(5));
};
$scenarios['search/release-group/ok-computer'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new ReleaseGroupFilter();
    $filter->addReleaseGroupNameWithoutAccents(new Name('OK Computer'));

    return $mb->api()->search()->releaseGroup($filter, $page(5));
};
$scenarios['search/recording/bohemian-rhapsody'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new RecordingFilter();
    $filter->addRecordingNameWithoutAccents(new Name('Bohemian Rhapsody'));

    return $mb->api()->search()->recording($filter, $page(5));
};
$scenarios['search/work/bohemian-rhapsody'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new WorkFilter();
    $filter->addWorkNameWithoutAccents(new Name('Bohemian Rhapsody'));

    return $mb->api()->search()->work($filter, $page(5));
};

// ---------------------------------------------------------------------------------------------------- more browse
$london = 'f03d09b3-39dc-4083-afd6-159e3f0d462f';
$scenarios['browse/place/by-area-london']                = static fn(MusicBrainz $mb) => $mb->api()->browse()->place($relation(PlaceRelation::class, 'area', $london), $full(new Browse\PlaceFields()), $page(10));
$scenarios['browse/release-group/by-artist-beatles']     = static fn(MusicBrainz $mb) => $mb->api()->browse()->releaseGroup($relation(ReleaseGroupRelation::class, 'artist', $beatles), $full(new Browse\ReleaseGroupFields()), $page(10));
$scenarios['browse/release-group/by-artist-radiohead']   = static fn(MusicBrainz $mb) => $mb->api()->browse()->releaseGroup($relation(ReleaseGroupRelation::class, 'artist', $radiohead), $full(new Browse\ReleaseGroupFields()), $page(10));
$scenarios['browse/recording/by-release-abbey-road']     = static fn(MusicBrainz $mb) => $mb->api()->browse()->recording($relation(RecordingRelation::class, 'release', '31765b9f-e969-4257-855f-c7ea1f657b2a'), $full(new Browse\RecordingFields()), $page(25));
$scenarios['browse/event/by-area-london']                = static fn(MusicBrainz $mb) => $mb->api()->browse()->event($relation(EventRelation::class, 'area', $london), $full(new Browse\EventFields()), $page(10));
$scenarios['browse/artist/by-release-group-abbey-road']  = static fn(MusicBrainz $mb) => $mb->api()->browse()->artist($relation(ArtistRelation::class, 'releaseGroup', '9162580e-5df4-32de-80cc-f45a8d8a9b1d'), $full(new Browse\ArtistFields()), $page(10));
$scenarios['browse/label/by-release-abbey-road']         = static fn(MusicBrainz $mb) => $mb->api()->browse()->label($relation(LabelRelation::class, 'release', '31765b9f-e969-4257-855f-c7ea1f657b2a'), $full(new Browse\LabelFields()), $page(10));

// ---------------------------------------------------------------------------------------------------- more search
$scenarios['search/place/abbey-road'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new PlaceFilter();
    $filter->addPlaceName(new Name('Abbey Road Studios'));

    return $mb->api()->search()->place($filter, $page(5));
};
$scenarios['search/tag/rock'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new TagFilter();
    $filter->addTagName(new Name('rock'));

    return $mb->api()->search()->tag($filter, $page(5));
};
$scenarios['search/annotation/beatles'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new AnnotationFilter();
    $filter->addEntityName(new Name('The Beatles'));

    return $mb->api()->search()->annotation($filter, $page(5));
};
$scenarios['search/cdstub/abbey-road'] = static function (MusicBrainz $mb) use ($page) {
    $filter = new CdStubFilter();
    $filter->addTitleComment(new Title('Abbey Road'));

    return $mb->api()->search()->cdStub($filter, $page(5));
};

// ---------------------------------------------------------------------------------------------------- authenticated
// Scenarios named "auth/..." need an OAuth2 access token (MB_ACCESS_TOKEN), see bin/record-fixtures. They use the
// public collection of the maintainer's account; user tags, ratings and genres are those of this account.
// The account name is only known while recording (MB_EDITOR); the store replaces it by "example-user"
$editor = getenv('MB_EDITOR') ?: 'example-user';
$collection = 'f27d2f80-0aff-4a0f-a8c3-296226073b20';
$withUser = static function (Fields $fields): Fields {
    foreach (get_class_methods($fields) as $method) {
        if (str_starts_with($method, 'include')) {
            $fields->$method();
        }
    }

    return $fields;
};
$scenarios['auth/lookup/collection/favourite-artists'] = static fn(MusicBrainz $mb) => $mb->api()->lookup()->collection($mbid($collection));
$scenarios['auth/browse/collection/by-editor'] = static function (MusicBrainz $mb) use ($page, $editor) {
    $relation = new CollectionRelation();
    $relation->editor($editor);

    return $mb->api()->browse()->collection($relation, $page(10));
};
$scenarios['auth/browse/artist/by-collection'] = static fn(MusicBrainz $mb) => $mb->api()->browse()->artist($relation(ArtistRelation::class, 'collection', $collection), $withUser(new Browse\ArtistFields()), $page(10));
// Collections created for these tests (type area, instrument, series); the area and instrument collections are empty
$scenarios['auth/browse/area/by-collection']       = static fn(MusicBrainz $mb) => $mb->api()->browse()->area($relation(AreaRelation::class, 'collection', 'abde7cff-3493-4c98-bc4a-1647f216331d'), $withUser(new Browse\AreaFields()), $page(10));
$scenarios['auth/browse/instrument/by-collection'] = static fn(MusicBrainz $mb) => $mb->api()->browse()->instrument($relation(InstrumentRelation::class, 'collection', '8e72551b-040d-49d5-afb5-70d37928de0a'), $withUser(new Browse\InstrumentFields()), $page(10));
$scenarios['auth/browse/series/by-collection']     = static fn(MusicBrainz $mb) => $mb->api()->browse()->series($relation(SeriesRelation::class, 'collection', '29b2933b-7282-4fc1-a03c-f4ca57855938'), $withUser(new Browse\SeriesFields()), $page(10));
foreach ([
    'artist'       => 'b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d',
    'release'      => '31765b9f-e969-4257-855f-c7ea1f657b2a',
    'releaseGroup' => '9162580e-5df4-32de-80cc-f45a8d8a9b1d',
    'recording'    => '106d1527-d378-4e55-ba49-d18f8e63ae8a',
    'work'         => '41c94a08-a551-3c86-bb17-d9a52e3a618b',
    'label'        => 'df7d1c7f-ef95-425f-8eef-445b3d7bcbd9',
] as $entity => $id) {
    $fieldsClass = 'MusicBrainz\\Supplement\\Lookup\\' . ucfirst($entity) . 'Fields';
    $scenarios["auth/lookup/$entity/user-data"] = static fn(MusicBrainz $mb) => $mb->api()->lookup()->$entity($mbid($id), (new $fieldsClass())->includeUserTags()->includeUserRatings()->includeUserGenres());
}

// ---------------------------------------------------------------------------------------------------- errors
// The library throws for 4xx responses; these scenarios return the exception, so that the contract can be asserted.
$catch = static function (callable $call): Throwable {
    try {
        $call();
    } catch (\MusicBrainz\Exception $exception) {
        return $exception;
    }
    throw new LogicException('The web service was expected to answer with an error');
};
$scenarios['error/lookup/artist-not-found'] = static fn(MusicBrainz $mb) => $catch(static fn() => $mb->api()->lookup()->artist($mbid('00000000-0000-4000-8000-000000000000'), new Lookup\ArtistFields()));
$scenarios['error/lookup/release-not-found'] = static fn(MusicBrainz $mb) => $catch(static fn() => $mb->api()->lookup()->release($mbid('00000000-0000-4000-8000-000000000000'), new Lookup\ReleaseFields()));

return $scenarios;
