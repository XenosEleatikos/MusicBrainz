<?php

namespace MusicBrainz\Api;

use MusicBrainz\Config;
use MusicBrainz\Filter\Browse\Relation\Entity\InstrumentRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\HttpAdapter\AbstractHttpAdapter;
use MusicBrainz\Filter\Browse\Relation\AbstractRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\AreaRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ArtistRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\CollectionRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\EventRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\LabelRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\PlaceRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\RecordingRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseGroupRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\SeriesRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\WorkRelation;
use MusicBrainz\Supplement\Browse\AreaFields;
use MusicBrainz\Supplement\Browse\ArtistFields;
use MusicBrainz\Supplement\Browse\EventFields;
use MusicBrainz\Supplement\Browse\InstrumentFields;
use MusicBrainz\Supplement\Browse\LabelFields;
use MusicBrainz\Supplement\Browse\PlaceFields;
use MusicBrainz\Supplement\Browse\RecordingFields;
use MusicBrainz\Supplement\Browse\ReleaseFields;
use MusicBrainz\Supplement\Browse\ReleaseGroupFields;
use MusicBrainz\Supplement\Browse\SeriesFields;
use MusicBrainz\Supplement\Browse\WorkFields;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\Page\AreaListPage;
use MusicBrainz\Value\Page\ArtistListPage;
use MusicBrainz\Value\Page\CollectionListPage;
use MusicBrainz\Value\Page\EventListPage;
use MusicBrainz\Value\Page\InstrumentListPage;
use MusicBrainz\Value\Page\LabelListPage;
use MusicBrainz\Value\Page\PlaceListPage;
use MusicBrainz\Value\Page\RecordingListPage;
use MusicBrainz\Value\Page\ReleaseGroupListPage;
use MusicBrainz\Value\Page\ReleaseListPage;
use MusicBrainz\Value\Page\SeriesListPage;
use MusicBrainz\Value\Page\WorkListPage;

/**
 * Browse requests are a direct lookup of all the entities directly linked to another entity.
 *
 * @link https://musicbrainz.org/doc/Development/XML_Web_Service/Version_2#Browse
 */
class Browse
{
    /**
     * An HTTP adapter
     *
     * @var AbstractHttpAdapter
     */
    private AbstractHttpAdapter $httpAdapter;

    /**
     * The API client configuration
     *
     * @var Config
     */
    private Config $config;

    /**
     * Constructs the browse API.
     *
     * @param AbstractHttpAdapter $httpAdapter An HTTP adapter
     * @param Config              $config      The API client configuration
     */
    public function __construct(AbstractHttpAdapter $httpAdapter, Config $config)
    {
        $this->httpAdapter = $httpAdapter;
        $this->config      = $config;
    }

    /**
     * Looks up for all areas standing in a certain relation.
     *
     * @param AreaRelation $areaRelation A relation, the requested areas stand in
     * @param AreaFields   $areaFields   A list of properties of the areas to be included in the response
     * @param PageFilter   $pageFilter   A page filter
     *
     * @return AreaListPage
     */
    public function area(AreaRelation $areaRelation, AreaFields $areaFields, PageFilter $pageFilter): AreaListPage
    {
        $fields = [
            'aliases'     => $areaFields->getIncludeFlagForAliases(),
            'annotation'  => $areaFields->getIncludeFlagForAnnotation(),
            'genres'      => $areaFields->getIncludeFlagForGenres(),
            'tags'        => $areaFields->getIncludeFlagForTags(),
            'user-genres' => $areaFields->getIncludeFlagForUserGenres(),
            'user-tags'   => $areaFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::AREA),
            $areaRelation,
            $fields,
            $pageFilter,
            (string)$areaRelation->getEntityType() === EntityType::COLLECTION
        );

        return AreaListPage::make($result, 'area');
    }

    /**
     * Looks up for all artists standing in a certain relation.
     *
     * @param ArtistRelation $artistRelation A relation, the requested artists stand in
     * @param ArtistFields   $artistFields   A list of properties of the artists to be included in the response
     * @param PageFilter     $pageFilter     A page filter
     *
     * @return ArtistListPage
     */
    public function artist(ArtistRelation $artistRelation, ArtistFields $artistFields, PageFilter $pageFilter): ArtistListPage
    {
        $fields = [
            'aliases'      => $artistFields->getIncludeFlagForAliases(),
            'annotation'   => $artistFields->getIncludeFlagForAnnotation(),
            'genres'       => $artistFields->getIncludeFlagForGenres(),
            'ratings'      => $artistFields->getIncludeFlagForRatings(),
            'tags'         => $artistFields->getIncludeFlagForTags(),
            'user-genres'  => $artistFields->getIncludeFlagForUserGenres(),
            'user-ratings' => $artistFields->getIncludeFlagForUserRatings(),
            'user-tags'    => $artistFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::ARTIST),
            $artistRelation,
            $fields,
            $pageFilter,
            $fields['user-genres'] || $fields['user-tags'] || $fields['user-ratings']
        );

        return ArtistListPage::make($result, 'artist');
    }

    /**
     * Looks up for all collections standing in a certain relation.
     *
     * The browse request for collection doesn't support any "inc" parameter.
     *
     * @param CollectionRelation $collectionRelation A relation, the requested collections stand in
     * @param PageFilter         $pageFilter         A page filter
     *
     * @return CollectionListPage
     */
    public function collection(CollectionRelation $collectionRelation, PageFilter $pageFilter): CollectionListPage
    {
        $fields = [];

        $result = $this->browse(
            new EntityType(EntityType::COLLECTION),
            $collectionRelation,
            $fields,
            $pageFilter
        );

        return CollectionListPage::make($result, 'collection');
    }

    /**
     * Looks up for all events standing in a certain relation.
     *
     * @param EventRelation $eventRelation A relation, the requested events stand in
     * @param EventFields   $eventFields   A list of properties of the events to be included in the response
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return EventListPage
     */
    public function event(EventRelation $eventRelation, EventFields $eventFields, PageFilter $pageFilter): EventListPage
    {
        $fields = [
            'aliases'     => $eventFields->getIncludeFlagForAliases(),
            'annotation'  => $eventFields->getIncludeFlagForAnnotation(),
            'genres'      => $eventFields->getIncludeFlagForGenres(),
            'tags'        => $eventFields->getIncludeFlagForTags(),
            'user-genres' => $eventFields->getIncludeFlagForUserGenres(),
            'user-tags'   => $eventFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::EVENT),
            $eventRelation,
            $fields,
            $pageFilter,
            $fields['user-genres'] || $fields['user-tags']
        );

        return EventListPage::make($result, 'event');
    }

    /**
     * Looks up for all instruments standing in a certain relation.
     *
     * @param InstrumentRelation $instrumentRelation A relation, the requested instruments stand in
     * @param InstrumentFields   $instrumentFields   A list of properties of the instrument to be included in the response
     * @param PageFilter         $pageFilter         A page filter
     *
     * @return InstrumentListPage
     */
    public function instrument(InstrumentRelation $instrumentRelation, InstrumentFields $instrumentFields, PageFilter $pageFilter): InstrumentListPage
    {
        $fields = [
            'aliases'     => $instrumentFields->getIncludeFlagForAliases(),
            'annotation'  => $instrumentFields->getIncludeFlagForAnnotation(),
            'genres'      => $instrumentFields->getIncludeFlagForGenres(),
            'tags'        => $instrumentFields->getIncludeFlagForTags(),
            'user-genres' => $instrumentFields->getIncludeFlagForUserGenres(),
            'user-tags'   => $instrumentFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::INSTRUMENT),
            $instrumentRelation,
            $fields,
            $pageFilter,
            $fields['user-genres'] || $fields['user-tags']
        );

        return InstrumentListPage::make($result, 'instrument');
    }

    /**
     * Looks up for all labels standing in a certain relation.
     *
     * @param LabelRelation $labelRelation A relation, the requested labels stand in
     * @param LabelFields   $labelFields   A list of properties of the labels to be included in the response
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return LabelListPage
     */
    public function label(LabelRelation $labelRelation, LabelFields $labelFields, PageFilter $pageFilter): LabelListPage
    {
        $fields = [
            'aliases'      => $labelFields->getIncludeFlagForAliases(),
            'annotation'   => $labelFields->getIncludeFlagForAnnotation(),
            'ratings'      => $labelFields->getIncludeFlagForRatings(),
            'tags'         => $labelFields->getIncludeFlagForTags(),
            'user-ratings' => $labelFields->getIncludeFlagForUserRatings(),
            'user-tags'    => $labelFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::LABEL),
            $labelRelation,
            $fields,
            $pageFilter
        );

        return LabelListPage::make($result, 'label');
    }

    /**
     * Looks up for all places standing in a certain relation.
     *
     * @param PlaceRelation $placeRelation A relation, the requested place stand in
     * @param PlaceFields   $placeFields   A list of properties of the places to be included in the response
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return PlaceListPage
     */
    public function place(PlaceRelation $placeRelation, PlaceFields $placeFields, PageFilter $pageFilter): PlaceListPage
    {
        $fields = [
            'aliases'      => $placeFields->getIncludeFlagForAliases(),
            'annotation'   => $placeFields->getIncludeFlagForAnnotation(),
            'tags'         => $placeFields->getIncludeFlagForTags(),
            'user-tags'    => $placeFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::PLACE),
            $placeRelation,
            $fields,
            $pageFilter
        );

        return PlaceListPage::make($result, 'place');
    }

    /**
     * Looks up for all recordings standing in a certain relation.
     *
     * @param RecordingRelation $recordingRelation A relation, the requested recording stand in
     * @param RecordingFields   $recordingFields   A list of properties of the recordings to be included in the response
     * @param PageFilter        $pageFilter        A page filter
     *
     * @return RecordingListPage
     */
    public function recording(RecordingRelation $recordingRelation, RecordingFields $recordingFields, PageFilter $pageFilter): RecordingListPage
    {
        $fields = [
            'annotation'     => $recordingFields->getIncludeFlagForAnnotation(),
            'artist-credits' => $recordingFields->getIncludeFlagForArtistCredits(),
            'isrcs'          => $recordingFields->getIncludeFlagForIsrcs(),
            'ratings'        => $recordingFields->getIncludeFlagForRatings(),
            'tags'           => $recordingFields->getIncludeFlagForTags(),
            'user-tags'      => $recordingFields->getIncludeFlagForUserTags(),
            'user-ratings'   => $recordingFields->getIncludeFlagForUserRatings()
        ];

        $result = $this->browse(
            new EntityType(EntityType::RECORDING),
            $recordingRelation,
            $fields,
            $pageFilter
        );

        return RecordingListPage::make($result, 'recording');
    }

    /**
     * Looks up for all releases standing in a certain relation.
     *
     * @param ReleaseRelation $releaseRelation A relation, the requested releases stand in
     * @param ReleaseFields   $releaseFields   A list of properties of the releases to be included in the response
     * @param PageFilter      $pageFilter      A page filter
     *
     * @return ReleaseListPage
     */
    public function release(ReleaseRelation $releaseRelation, ReleaseFields $releaseFields, PageFilter $pageFilter): ReleaseListPage
    {
        $fields = [
            'annotation'     => $releaseFields->getIncludeFlagForAnnotation(),
            'artist-credits' => $releaseFields->getIncludeFlagForArtistCredits(),
            'discids'        => $releaseFields->getIncludeFlagForDiscIds(),
            'isrcs'          => $releaseFields->getIncludeFlagForIsrcs(),
            'labels'         => $releaseFields->getIncludeFlagForLabels(),
            'media'          => $releaseFields->getIncludeFlagForMedia(),
            'recordings'     => $releaseFields->getIncludeFlagForRecordings(),
            'release-groups' => $releaseFields->getIncludeFlagForReleaseGroups()
        ];

        $result = $this->browse(
            new EntityType(EntityType::RELEASE),
            $releaseRelation,
            $fields,
            $pageFilter
        );

        return ReleaseListPage::make($result, 'release');
    }

    /**
     * Looks up for all release groups standing in a certain relation.
     *
     * @param ReleaseGroupRelation $releaseRelation    A relation, the requested release groups stand in
     * @param ReleaseGroupFields   $releaseGroupFields A list of properties of the release groups to be included in the
     *                                                 response
     * @param PageFilter           $pageFilter         A page filter
     *
     * @return ReleaseGroupListPage
     */
    public function releaseGroup(
        ReleaseGroupRelation $releaseRelation,
        ReleaseGroupFields $releaseGroupFields,
        PageFilter $pageFilter
    ): ReleaseGroupListPage {
        $fields = [
            'annotation'     => $releaseGroupFields->getIncludeFlagForAnnotation(),
            'artist-credits' => $releaseGroupFields->getIncludeFlagForArtistCredits(),
            'ratings'        => $releaseGroupFields->getIncludeFlagForRatings(),
            'tags'           => $releaseGroupFields->getIncludeFlagForTags(),
            'user-ratings'   => $releaseGroupFields->getIncludeFlagForUserRatings(),
            'user-tags'      => $releaseGroupFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::RELEASE_GROUP),
            $releaseRelation,
            $fields,
            $pageFilter
        );

        return ReleaseGroupListPage::make($result, 'release-group');
    }

    /**
     * Looks up for all series standing in a certain relation.
     *
     * @param SeriesRelation $seriesRelation A relation, the requested series stand in
     * @param SeriesFields   $seriesFields   A list of properties of the series to be included in the response
     * @param PageFilter      $pageFilter    A page filter
     *
     * @return SeriesListPage
     */
    public function series(SeriesRelation $seriesRelation, SeriesFields $seriesFields, PageFilter $pageFilter): SeriesListPage
    {
        $fields = [
            'aliases'      => $seriesFields->getIncludeFlagForAliases(),
            'annotation'   => $seriesFields->getIncludeFlagForAnnotation(),
            'tags'         => $seriesFields->getIncludeFlagForTags(),
            'user-tags'    => $seriesFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::SERIES),
            $seriesRelation,
            $fields,
            $pageFilter
        );

        return SeriesListPage::make($result, 'series');
    }

    /**
     * @todo Implement browse URL!
     */

    /**
     * Looks up for all works standing in a certain relation.
     *
     * @param WorkRelation $workRelation A relation, the requested series stand in
     * @param WorkFields   $workFields   A list of properties of the series to be included in the response
     * @param PageFilter   $pageFilter   A page filter
     *
     * @return WorkListPage
     */
    public function work(WorkRelation $workRelation, WorkFields $workFields, PageFilter $pageFilter): WorkListPage
    {
        $fields = [
            'aliases'      => $workFields->getIncludeFlagForAliases(),
            'annotation'   => $workFields->getIncludeFlagForAnnotation(),
            'ratings'      => $workFields->getIncludeFlagForRatings(),
            'tags'         => $workFields->getIncludeFlagForTags(),
            'user-ratings' => $workFields->getIncludeFlagForUserRatings(),
            'user-tags'    => $workFields->getIncludeFlagForUserTags()
        ];

        $result = $this->browse(
            new EntityType(EntityType::WORK),
            $workRelation,
            $fields,
            $pageFilter
        );

        return WorkListPage::make($result, 'work');
    }

    /**
     * Looks up for entities standing in a certain relation.
     *
     * @param EntityType       $entity       The type of the requested entities
     * @param AbstractRelation $relation     The type of the related entity
     * @param array            $includes     A list of properties of the requested entities to be included in the response
     * @param PageFilter       $pageFilter   A page filter
     * @param bool             $authRequired True, if user authentication is required
     *
     * @return array
     */
    private function browse(
        EntityType $entity,
        AbstractRelation $relation,
        array $includes,
        PageFilter $pageFilter,
        bool $authRequired = false
    ) {
        $includes = array_keys(array_filter($includes));

        $params = [
            (string) $relation->getEntityType()  => (string) $relation->getEntityId(),
            'limit'                              => $pageFilter->getLimit(),
            'offset'                             => $pageFilter->getOffset(),
            'fmt'                                => 'json'
        ];

        if (!empty($includes)) {
            $params['inc'] = implode('+', $includes);
        }

        $response = $this->httpAdapter->call(str_replace('_', '-', (string) $entity), $this->config, $params, $authRequired);

        return $response;
    }
}
