<?php

declare(strict_types=1);

namespace MusicBrainz\Api;

use MusicBrainz\Value\Area;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\Collection;
use MusicBrainz\Value\Event;
use MusicBrainz\Value\Instrument;
use MusicBrainz\Value\Label;
use MusicBrainz\Value\Place;
use MusicBrainz\Value\Recording;
use MusicBrainz\Value\Release;
use MusicBrainz\Value\ReleaseGroup;
use MusicBrainz\Value\Series;
use MusicBrainz\Value\Work;
use MusicBrainz\Value\URL;
use MusicBrainz\Config;
use MusicBrainz\Filter\Browse\Relation\AbstractRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\AreaRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ArtistRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\CollectionRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\EventRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\InstrumentRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\LabelRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\PlaceRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\RecordingRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseGroupRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\SeriesRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\WorkRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Http\ApiClient;
use MusicBrainz\Supplement\Browse\AreaFields;
use MusicBrainz\Supplement\Browse\ArtistFields;
use MusicBrainz\Supplement\Browse\CollectionFields;
use MusicBrainz\Supplement\Browse\EventFields;
use MusicBrainz\Supplement\Browse\InstrumentFields;
use MusicBrainz\Supplement\Browse\LabelFields;
use MusicBrainz\Supplement\Browse\PlaceFields;
use MusicBrainz\Supplement\Browse\RecordingFields;
use MusicBrainz\Supplement\Browse\ReleaseFields;
use MusicBrainz\Supplement\Browse\ReleaseGroupFields;
use MusicBrainz\Supplement\Browse\SeriesFields;
use MusicBrainz\Supplement\Browse\WorkFields;
use MusicBrainz\Supplement\Fields;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\Page;

/**
 * Browse requests are a direct lookup of all the entities directly linked to another entity.
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API#Browse
 */
final class Browse
{
    /**
     * The API client
     *
     * @var ApiClient
     */
    private ApiClient $apiClient;

    /**
     * The API client configuration
     *
     * @var Config
     */
    private Config $config;

    /**
     * Constructs the browse API.
     *
     * @param ApiClient $apiClient The API client
     * @param Config    $config    The API client configuration
     *
     * @internal
     */
    public function __construct(ApiClient $apiClient, Config $config)
    {
        $this->apiClient = $apiClient;
        $this->config = $config;
    }

    /**
     * Looks up all areas standing in a certain relation.
     *
     * @param AreaRelation $areaRelation A relation, the requested areas stand in
     * @param AreaFields   $areaFields   A list of properties of the areas to be included in the response
     * @param PageFilter   $pageFilter   A page filter
     *
     * @return Page<Area>
     */
    public function area(AreaRelation $areaRelation, AreaFields $areaFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Area,
            $areaRelation,
            $areaFields,
            $pageFilter
        );

        return Page::browse($result, 'area', Area::class);
    }

    /**
     * Looks up all artists standing in a certain relation.
     *
     * @param ArtistRelation $artistRelation A relation, the requested artists stand in
     * @param ArtistFields   $artistFields   A list of properties of the artists to be included in the response
     * @param PageFilter     $pageFilter     A page filter
     *
     * @return Page<Artist>
     */
    public function artist(ArtistRelation $artistRelation, ArtistFields $artistFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Artist,
            $artistRelation,
            $artistFields,
            $pageFilter
        );

        return Page::browse($result, 'artist', Artist::class);
    }

    /**
     * Looks up all collections standing in a certain relation.
     *
     * The browse request for collection doesn't support any "inc" parameter.
     *
     * @param CollectionRelation $collectionRelation A relation, the requested collections stand in
     * @param PageFilter         $pageFilter         A page filter
     *
     * @return Page<Collection>
     */
    public function collection(CollectionRelation $collectionRelation, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Collection,
            $collectionRelation,
            new CollectionFields(),
            $pageFilter
        );

        return Page::browse($result, 'collection', Collection::class);
    }

    /**
     * Looks up all events standing in a certain relation.
     *
     * @param EventRelation $eventRelation A relation, the requested events stand in
     * @param EventFields   $eventFields   A list of properties of the events to be included in the response
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return Page<Event>
     */
    public function event(EventRelation $eventRelation, EventFields $eventFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Event,
            $eventRelation,
            $eventFields,
            $pageFilter
        );

        return Page::browse($result, 'event', Event::class);
    }

    /**
     * Looks up all instruments standing in a certain relation.
     *
     * @param InstrumentRelation $instrumentRelation A relation, the requested instruments stand in
     * @param InstrumentFields   $instrumentFields   A list of properties of the instrument to be included in the response
     * @param PageFilter         $pageFilter         A page filter
     *
     * @return Page<Instrument>
     */
    public function instrument(InstrumentRelation $instrumentRelation, InstrumentFields $instrumentFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Instrument,
            $instrumentRelation,
            $instrumentFields,
            $pageFilter
        );

        return Page::browse($result, 'instrument', Instrument::class);
    }

    /**
     * Looks up all labels standing in a certain relation.
     *
     * @param LabelRelation $labelRelation A relation, the requested labels stand in
     * @param LabelFields   $labelFields   A list of properties of the labels to be included in the response
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return Page<Label>
     */
    public function label(LabelRelation $labelRelation, LabelFields $labelFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Label,
            $labelRelation,
            $labelFields,
            $pageFilter
        );

        return Page::browse($result, 'label', Label::class);
    }

    /**
     * Looks up all places standing in a certain relation.
     *
     * @param PlaceRelation $placeRelation A relation, the requested place stand in
     * @param PlaceFields   $placeFields   A list of properties of the places to be included in the response
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return Page<Place>
     */
    public function place(PlaceRelation $placeRelation, PlaceFields $placeFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Place,
            $placeRelation,
            $placeFields,
            $pageFilter
        );

        return Page::browse($result, 'place', Place::class);
    }

    /**
     * Looks up all recordings standing in a certain relation.
     *
     * @param RecordingRelation $recordingRelation A relation, the requested recording stand in
     * @param RecordingFields   $recordingFields   A list of properties of the recordings to be included in the response
     * @param PageFilter        $pageFilter        A page filter
     *
     * @return Page<Recording>
     */
    public function recording(RecordingRelation $recordingRelation, RecordingFields $recordingFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Recording,
            $recordingRelation,
            $recordingFields,
            $pageFilter
        );

        return Page::browse($result, 'recording', Recording::class);
    }

    /**
     * Looks up all releases standing in a certain relation.
     *
     * @param ReleaseRelation $releaseRelation A relation, the requested releases stand in
     * @param ReleaseFields   $releaseFields   A list of properties of the releases to be included in the response
     * @param PageFilter      $pageFilter      A page filter
     *
     * @return Page<Release>
     */
    public function release(ReleaseRelation $releaseRelation, ReleaseFields $releaseFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Release,
            $releaseRelation,
            $releaseFields,
            $pageFilter
        );

        return Page::browse($result, 'release', Release::class);
    }

    /**
     * Looks up all release groups standing in a certain relation.
     *
     * @param ReleaseGroupRelation $releaseRelation    A relation, the requested release groups stand in
     * @param ReleaseGroupFields   $releaseGroupFields A list of properties of the release groups to be included in the
     *                                                 response
     * @param PageFilter           $pageFilter         A page filter
     *
     * @return Page<ReleaseGroup>
     */
    public function releaseGroup(
        ReleaseGroupRelation $releaseRelation,
        ReleaseGroupFields $releaseGroupFields,
        PageFilter $pageFilter
    ): Page {
        $result = $this->browse(
            EntityType::ReleaseGroup,
            $releaseRelation,
            $releaseGroupFields,
            $pageFilter
        );

        return Page::browse($result, 'release-group', ReleaseGroup::class);
    }

    /**
     * Looks up all series standing in a certain relation.
     *
     * @param SeriesRelation $seriesRelation A relation, the requested series stand in
     * @param SeriesFields   $seriesFields   A list of properties of the series to be included in the response
     * @param PageFilter      $pageFilter    A page filter
     *
     * @return Page<Series>
     */
    public function series(SeriesRelation $seriesRelation, SeriesFields $seriesFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Series,
            $seriesRelation,
            $seriesFields,
            $pageFilter
        );

        return Page::browse($result, 'series', Series::class);
    }

    /**
     * @todo Implement browse URL!
     */

    /**
     * Looks up all works standing in a certain relation.
     *
     * @param WorkRelation $workRelation A relation, the requested series stand in
     * @param WorkFields   $workFields   A list of properties of the series to be included in the response
     * @param PageFilter   $pageFilter   A page filter
     *
     * @return Page<Work>
     */
    public function work(WorkRelation $workRelation, WorkFields $workFields, PageFilter $pageFilter): Page
    {
        $result = $this->browse(
            EntityType::Work,
            $workRelation,
            $workFields,
            $pageFilter
        );

        return Page::browse($result, 'work', Work::class);
    }

    /**
     * Looks up entities standing in a certain relation.
     *
     * @param EntityType       $entity     The type of the requested entities
     * @param AbstractRelation $relation   The type of the related entity
     * @param Fields           $includes   A list of properties of the requested entities to be included in the response
     * @param PageFilter       $pageFilter A page filter
     *
     * @return array<mixed, mixed>
     */
    private function browse(
        EntityType $entity,
        AbstractRelation $relation,
        Fields $includes,
        PageFilter $pageFilter,
    ): array {
        $includes = (string) $includes;

        $params = [
            $relation->getEntityType()->browseParameter() => (string) $relation->getEntityId(),
            'limit' => $pageFilter->limit,
            'offset' => $pageFilter->offset,
            'fmt' => 'json',
        ];

        if (!empty($includes)) {
            $params['inc'] = $includes;
        }

        return $this->apiClient->call($entity->path(), $this->config, $params, str_contains($includes, 'user-'));
    }
}
