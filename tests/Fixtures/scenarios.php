<?php

declare(strict_types=1);

/**
 * Scenarios for bin/record-fixtures: each one performs a request with the library against the live MusicBrainz web
 * service. Popular, well maintained entities are used wherever possible; a few sparse ones cover empty/null cases.
 *
 * The response of every request is stored as fixture, see tests/Fixtures/recorded.
 */

use MusicBrainz\Filter\Browse\Relation\Entity\ArtistRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\EventRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\LabelRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\RecordingRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\WorkRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Search\AreaFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Filter\Search\LabelFilter;
use MusicBrainz\Filter\Search\RecordingFilter;
use MusicBrainz\Filter\Search\ReleaseFilter;
use MusicBrainz\Filter\Search\ReleaseGroupFilter;
use MusicBrainz\Filter\Search\WorkFilter;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Supplement\Browse;
use MusicBrainz\Supplement\Fields;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Name;

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

$scenarios['browse/release/by-artist-beatles']        = static fn(MusicBrainz $mb) => $mb->api()->browse()->release($relation(ReleaseRelation::class, 'artist', $beatles), new Browse\ReleaseFields(), $page(25));
$scenarios['browse/release/by-artist-beatles/page-2'] = static fn(MusicBrainz $mb) => $mb->api()->browse()->release($relation(ReleaseRelation::class, 'artist', $beatles), new Browse\ReleaseFields(), $page(25, 25));
$scenarios['browse/release/by-label-parlophone']      = static fn(MusicBrainz $mb) => $mb->api()->browse()->release($relation(ReleaseRelation::class, 'label', 'df7d1c7f-ef95-425f-8eef-445b3d7bcbd9'), new Browse\ReleaseFields(), $page(10));
$scenarios['browse/recording/by-artist-radiohead']    = static fn(MusicBrainz $mb) => $mb->api()->browse()->recording($relation(RecordingRelation::class, 'artist', $radiohead), new Browse\RecordingFields(), $page(25));
$scenarios['browse/work/by-artist-bach']              = static fn(MusicBrainz $mb) => $mb->api()->browse()->work($relation(WorkRelation::class, 'artist', $bach), new Browse\WorkFields(), $page(25));
$scenarios['browse/event/by-artist-radiohead']        = static fn(MusicBrainz $mb) => $mb->api()->browse()->event($relation(EventRelation::class, 'artist', $radiohead), new Browse\EventFields(), $page(10));
$scenarios['browse/artist/by-area-germany']           = static fn(MusicBrainz $mb) => $mb->api()->browse()->artist($relation(ArtistRelation::class, 'area', '85752fda-13c4-31a3-bee5-0e5cb1f51dad'), new Browse\ArtistFields(), $page(10));
$scenarios['browse/label/by-area-germany']            = static fn(MusicBrainz $mb) => $mb->api()->browse()->label($relation(LabelRelation::class, 'area', '85752fda-13c4-31a3-bee5-0e5cb1f51dad'), new Browse\LabelFields(), $page(10));

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

return $scenarios;
