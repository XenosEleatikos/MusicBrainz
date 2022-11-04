<?php

namespace MusicBrainz\Api;

use MusicBrainz\Config;
use MusicBrainz\Supplement\Lookup\AreaFields;
use MusicBrainz\Supplement\Lookup\ArtistFields;
use MusicBrainz\Supplement\Lookup\PlaceFields;
use MusicBrainz\Supplement\Lookup\EventFields;
use MusicBrainz\Supplement\Lookup\InstrumentFields;
use MusicBrainz\Supplement\Lookup\LabelFields;
use MusicBrainz\Supplement\Lookup\RecordingFields;
use MusicBrainz\Supplement\Lookup\ReleaseFields;
use MusicBrainz\Supplement\Lookup\UrlFields;
use MusicBrainz\HttpAdapter\AbstractHttpAdapter;
use MusicBrainz\Supplement\Lookup\ReleaseGroupFields;
use MusicBrainz\Supplement\Lookup\SeriesFields;
use MusicBrainz\Supplement\Lookup\WorkFields;
use MusicBrainz\Value\Area;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\Collection;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\Event;
use MusicBrainz\Value\Instrument;
use MusicBrainz\Value\Label;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Place;
use MusicBrainz\Value\Recording;
use MusicBrainz\Value\Release;
use MusicBrainz\Value\ReleaseGroup;
use MusicBrainz\Value\Series;
use MusicBrainz\Value\URL;
use MusicBrainz\Value\Work;

/**
 * Lookups are direct queries for entities specified by a MusicBrainz Identifier (MBID).
 *
 * @link https://musicbrainz.org/doc/Development/XML_Web_Service/Version_2#Lookups
 */
class Lookup
{
    /**
     * An HTTP adapter
     *
     * @var AbstractHttpAdapter
     */
    private $httpAdapter;

    /**
     * The API client configuration
     *
     * @var Config
     */
    private $config;

    /**
     * Constructs the search API.
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
     * Looks up for an area and returns the result.
     *
     * @param MBID       $mbid       A Music Brainz Identifier (MBID) of an area
     * @param AreaFields $areaFields List of fields to be included in the response
     *
     * @return Area
     */
    public function area(MBID $mbid, AreaFields $areaFields): Area
    {
        $fields = [
            'area-rels'          => $areaFields->getIncludeFlagForAreaRelations(),
            'event-rels'         => $areaFields->getIncludeFlagForEventRelations(),
            'instrument-rels'    => $areaFields->includeInstrumentRelations(),
            'recording-rels'     => $areaFields->getIncludeFlagForRecordingRelations(),
            'release-rels'       => $areaFields->getIncludeFlagForReleaseRelations(),
            'url-rels'           => $areaFields->getIncludeFlagForURLRelations(),
            'work-rels'          => $areaFields->getIncludeFlagForWorkRelations()
        ];

        $result = $this->lookup(new EntityType(EntityType::AREA), $mbid, $fields);

        return new Area($result);
    }

    /**
     * Looks up for an artist and returns the result.
     *
     * @param MBID         $mbid         A Music Brainz Identifier (MBID) of an artist
     * @param ArtistFields $artistFields List of fields to be included in the response
     * @return Artist
     */
    public function artist(MBID $mbid, ArtistFields $artistFields): Artist
    {
        $fields = [
            'recordings'         => $artistFields->getIncludeFlagForRecordings(),
            'releases'           => $artistFields->getIncludeFlagForReleases(),
            'release-groups'     => $artistFields->getIncludeFlagForReleaseGroups(),
            'works'              => $artistFields->getIncludeFlagForWorks(),
            'various-artists'    => $artistFields->getIncludeFlagForVariousArtists(),
            'discids'            => $artistFields->getIncludeFlagForDiscIds(),
            'media'              => $artistFields->getIncludeFlagForMedia(),
            'aliases'            => $artistFields->getIncludeFlagForAliases(),
            'tags'               => $artistFields->getIncludeFlagForTags(),
            'user-tags'          => $artistFields->getIncludeFlagForUserTags(),
            'ratings'            => $artistFields->getIncludeFlagForRatings(),
            'user-ratings'       => $artistFields->getIncludeFlagForUserRatings(),
            'annotation'         => $artistFields->getIncludeFlagForAnnotation(),
            // relations
            'artist-rels'        => $artistFields->getIncludeFlagForArtistRelations(),
            'event-rels'         => $artistFields->getIncludeFlagForEventRelations(),
            'instrument-rels'    => $artistFields->includeInstrumentRelations(),
            'label-rels'         => $artistFields->getIncludeFlagForLabelRelations(),
            'place-rels'         => $artistFields->getIncludeFlagForPlaceRelations(),
            'recording-rels'     => $artistFields->getIncludeFlagForRecordingRelations(),
            'release-group-rels' => $artistFields->getIncludeFlagForReleaseGroupRelations(),
            'release-rels'       => $artistFields->getIncludeFlagForReleaseRelations(),
            'series-rels'        => $artistFields->getIncludeFlagForSeriesRelations(),
            'url-rels'           => $artistFields->getIncludeFlagForURLRelations(),
            'work-rels'          => $artistFields->getIncludeFlagForWorkRelations()
        ];

        $authRequired = ($fields['user-ratings'] || $fields['user-tags']);

        $result = $this->lookup(new EntityType(EntityType::ARTIST), $mbid, $fields, $authRequired);

        return new Artist($result);
    }

    /**
     * Looks up for a collection and returns the result.
     *
     * @param MBID $mbid A Music Brainz Identifier (MBID) of a collection
     *
     * @return Collection
     */
    public function collection(MBID $mbid): Collection
    {
        $fields = [];

        $result = $this->lookup(new EntityType(EntityType::COLLECTION), $mbid, $fields, true);

        return new Collection($result);
    }

    /**
     * Looks up for an event and returns the result.
     *
     * @param MBID        $mbid        A Music Brainz Identifier (MBID) of an event
     * @param EventFields $eventFields List of fields to be included in the response
     *
     * @return Event
     */
    public function event(MBID $mbid, EventFields $eventFields)
    {
        $fields = [
            // relations
            'area-rels'          => $eventFields->getIncludeFlagForAreaRelations(),
            'artist-rels'        => $eventFields->getIncludeFlagForArtistRelations(),
            'event-rels'         => $eventFields->getIncludeFlagForEventRelations(),
            'place-rels'         => $eventFields->getIncludeFlagForPlaceRelations(),
            'recording-rels'     => $eventFields->getIncludeFlagForRecordingRelations(),
            'release-group-rels' => $eventFields->getIncludeFlagForReleaseGroupRelations(),
            'release-rels'       => $eventFields->getIncludeFlagForReleaseRelations(),
            'series-rels'        => $eventFields->getIncludeFlagForSeriesRelations(),
            'url-rels'           => $eventFields->getIncludeFlagForURLRelations(),
            'work-rels'          => $eventFields->getIncludeFlagForWorkRelations()
        ];

        $result = $this->lookup(new EntityType(EntityType::EVENT), $mbid, $fields);

        return new Event($result);
    }

    /**
     * Looks up for an instrument and returns the result.
     *
     * @param MBID             $mbid             A Music Brainz Identifier (MBID) of an instrument
     * @param InstrumentFields $instrumentFields List of fields to be included in the response
     *
     * @return Instrument
     */
    public function instrument(MBID $mbid, $instrumentFields): Instrument
    {
        $fields = [
            // relations
            'area-rels'       => $instrumentFields->getIncludeFlagForAreaRelations(),
            'artist-rels'     => $instrumentFields->getIncludeFlagForArtistRelations(),
            'instrument-rels' => $instrumentFields->getIncludeFlagForInstrumentRelations(),
            'label-rels'      => $instrumentFields->getIncludeFlagForLabelRelations(),
            'url-rels'        => $instrumentFields->getIncludeFlagForURLRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::INSTRUMENT), $mbid, $fields);

        return new Instrument($result);
    }

    /**
     * Looks up for a label and returns the result.
     *
     * @param MBID $mbid A Music Brainz Identifier (MBID) of a label
     *
     * @return Label
     */
    public function label(MBID $mbid, LabelFields $labelFields): Label
    {
        $fields = [
            'releases'           => $labelFields->getIncludeFlagForReleases(),
            'discids'            => $labelFields->getIncludeFlagForDiscIds(),
            'media'              => $labelFields->getIncludeFlagForMedia(),
            'aliases'            => $labelFields->getIncludeFlagForAliases(),
            'tags'               => $labelFields->getIncludeFlagForTags(),
            'user-tags'          => $labelFields->getIncludeFlagForUserTags(),
            'ratings'            => $labelFields->getIncludeFlagForRatings(),
            'user-ratings'       => $labelFields->getIncludeFlagForUserRatings(), // misc
            'artist-rels'        => $labelFields->getIncludeFlagForArtistRelations(),
            'label-rels'         => $labelFields->getIncludeFlagForLabelRelations(),
            'recording-rels'     => $labelFields->getIncludeFlagForRecordingRelations(),
            'release-rels'       => $labelFields->getIncludeFlagForReleaseRelations(),
            'release-group-rels' => $labelFields->getIncludeFlagForReleaseGroupRelations(),
            'url-rels'           => $labelFields->getIncludeFlagForURLRelations(),
            'work-rels'          => $labelFields->getIncludeFlagForWorkRelations(),
            'annotation'         => $labelFields->getIncludeFlagForAnnotation()
        ];

        $result = $this->lookup(new EntityType(EntityType::LABEL), $mbid, $fields);

        return new Label($result);
    }

    /**
     * Looks up for a place and returns the result.
     *
     * @param MBID        $mbid        A Music Brainz Identifier (MBID) of a label
     * @param PlaceFields $placeFields List of fields to be included in the response
     *
     * @return Place
     */
    public function place(MBID $mbid, PlaceFields $placeFields): Place
    {
        $fields = [
            'artist-rels'    => $placeFields->getIncludeFlagForArtistRelations(),
            'place-rels'     => $placeFields->getIncludeFlagForPlaceRelations(),
            'recording-rels' => $placeFields->getIncludeFlagForRecordingRelations(),
            'release-rels'   => $placeFields->getIncludeFlagForReleaseRelations(),
            'url-rels'       => $placeFields->getIncludeFlagForURLRelations(),
            'work-rels'      => $placeFields->getIncludeFlagForWorkRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::PLACE), $mbid, $fields);

        return new Place($result);
    }

    /**
     * Looks up for a recording and returns the result.
     *
     * @param MBID            $mbid        A Music Brainz Identifier (MBID) of a recording
     * @param RecordingFields $placeFields List of fields to be included in the response
     *
     * @return Recording
     */
    public function recording(MBID $mbid, RecordingFields $recordingFields): Recording
    {
        $fields = [
            'area-rels'      => $recordingFields->getIncludeFlagForAreaRelations(),
            'artist-rels'    => $recordingFields->getIncludeFlagForArtistRelations(),
            'event-rels'     => $recordingFields->getIncludeFlagForEventRelations(),
            'label-rels'     => $recordingFields->getIncludeFlagForLabelRelations(),
            'place-rels'     => $recordingFields->getIncludeFlagForPlaceRelations(),
            'recording-rels' => $recordingFields->getIncludeFlagForRecordingRelations(),
            'release-rels'   => $recordingFields->getIncludeFlagForReleaseRelations(),
            'series-rels'    => $recordingFields->getIncludeFlagForSeriesRelations(),
            'url-rels'       => $recordingFields->getIncludeFlagForURLRelations(),
            'work-rels'      => $recordingFields->getIncludeFlagForWorkRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::RECORDING), $mbid, $fields);

        return new Recording($result);
    }

    /**
     * Looks up for a release and returns the result.
     *
     * @param MBID            $mbid          A Music Brainz Identifier (MBID) of a release
     * @param RecordingFields $releaseFields List of fields to be included in the response
     *
     * @return Release
     */
    public function release(MBID $mbid, ReleaseFields $releaseFields): Release
    {
        $fields = [
            'artists'              => $releaseFields->getIncludeFlagForArtists(),
            'collections'          => $releaseFields->getIncludeFlagForCollections(),
            'labels'               => $releaseFields->getIncludeFlagForLabels(), // sub queries
            'recordings'           => $releaseFields->getIncludeFlagForRecordings(),
            'release-groups'       => $releaseFields->getIncludeFlagForReleases(),
            //
            'media'                => $releaseFields->getIncludeFlagForMedia(),
            'artist-credits'       => $releaseFields->getIncludeFlagForArtistCredits(),
            'discids'              => $releaseFields->getIncludeFlagForDiscIds(),
            'annotation'           => $releaseFields->getIncludeFlagForAnnotation(),
            'aliases'              => $releaseFields->getIncludeFlagForAliases(),
            // relations
            'area-rels'            => $releaseFields->getIncludeFlagForAreaRelations(),
            'artist-rels'          => $releaseFields->getIncludeFlagForArtistRelations(),
            'event-rels'           => $releaseFields->getIncludeFlagForEventRelations(),
            'label-rels'           => $releaseFields->getIncludeFlagForLabelRelations(), // misc
            'recording-rels'       => $releaseFields->getIncludeFlagForRecordingRelations(),
            'release-rels'         => $releaseFields->getIncludeFlagForReleaseRelations(),
            'series-rels'          => $releaseFields->getIncludeFlagForSeriesRelations(),
            'url-rels'             => $releaseFields->getIncludeFlagForURLRelations(),
            //
            'recording-level-rels' => $releaseFields->getIncludeFlagForRecordingLevelRelations(),
            'work-level-rels'      => $releaseFields->getIncludeFlagForWorkLevelRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::RELEASE), $mbid, $fields);

        return new Release($result);
    }

    /**
     * Looks up for a release group and returns the result.
     *
     * @param MBID               $mbid          A Music Brainz Identifier (MBID) of a release
     * @param ReleaseGroupFields $releaseFields List of fields to be included in the response
     *
     * @return ReleaseGroup
     */
    public function releaseGroup(MBID $mbid, ReleaseGroupFields $releaseGroupFields): ReleaseGroup
    {
        $fields = [
            'aliases'            => $releaseGroupFields->getIncludeFlagForAliases(),
            'artists'            => $releaseGroupFields->getIncludeFlagForArtists(),
            'releases'           => $releaseGroupFields->getIncludeFlagForReleases(),
            'discids'            => $releaseGroupFields->getIncludeFlagForDiscIds(),
            'media'              => $releaseGroupFields->getIncludeFlagForMedia(),
            'artist-credits'     => $releaseGroupFields->getIncludeFlagForArtistCredits(),
            'tags'               => $releaseGroupFields->getIncludeFlagForTags(),
            'user-tags'          => $releaseGroupFields->getIncludeFlagForUserTags(),
            'ratings'            => $releaseGroupFields->getIncludeFlagForRatings(),
            'user-ratings'       => $releaseGroupFields->getIncludeFlagForUserRatings(),
            // relations
            'artist-rels'        => $releaseGroupFields->getIncludeFlagForArtistRelations(),
            'event-rels'         => $releaseGroupFields->getIncludeFlagForEventRelations(),
            'label-rels'         => $releaseGroupFields->getIncludeFlagForLabelRelations(),
            'release-group-rels' => $releaseGroupFields->getIncludeFlagForReleaseGroupRelations(),
            'series-rels'        => $releaseGroupFields->getIncludeFlagForSeriesRelations(),
            'url-rels'           => $releaseGroupFields->getIncludeFlagForURLRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::RELEASE_GROUP), $mbid, $fields);

        return new ReleaseGroup($result);
    }

    /**
     * Looks up for an URL and returns the result.
     *
     * @param MBID         $mbid          A Music Brainz Identifier (MBID) of a release
     * @param SeriesFields $releaseFields List of fields to be included in the response
     *
     * @return Series
     */
    public function series(MBID $mbid, SeriesFields $seriesFields): Series
    {
        $fields = [
            // relations
            'artist-rels'        => $seriesFields->getIncludeFlagForArtistRelations(),
            'event-rels'         => $seriesFields->getIncludeFlagForEventRelations(),
            'label-rels'         => $seriesFields->getIncludeFlagForLabelRelations(),
            'recording-rels'     => $seriesFields->getIncludeFlagForRecordingRelations(),
            'release-rels'       => $seriesFields->getIncludeFlagForReleaseRelations(),
            'release-group-rels' => $seriesFields->getIncludeFlagForReleaseGroupRelations(),
            'series-rels'        => $seriesFields->getIncludeFlagForSeriesRelations(),
            'url-rels'           => $seriesFields->getIncludeFlagForURLRelations(),
            'work-rels'          => $seriesFields->getIncludeFlagForWorkRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::SERIES), $mbid, $fields);

        return new Series($result);
    }

    /**
     * Looks up for an URL and returns the result.
     *
     * @param MBID         $mbid          A Music Brainz Identifier (MBID) of a release
     * @param UrlFields $urlFields List of fields to be included in the response
     *
     * @return URL
     */
    public function url(MBID $mbid, $urlFields): URL
    {
        $fields = [
            // relations
            'area-rels'          => $urlFields->getIncludeFlagForAreaRelations(),
            'artist-rels'        => $urlFields->getIncludeFlagForArtistRelations(),
            'event-rels'         => $urlFields->getIncludeFlagForEventRelations(),
            'instrument-rels'    => $urlFields->getIncludeFlagForInstrumentRelations(),
            'label-rels'         => $urlFields->getIncludeFlagForLabelRelations(),
            'place-rels'         => $urlFields->getIncludeFlagForPlaceRelations(),
            'recording-rels'     => $urlFields->getIncludeFlagForRecordingRelations(),
            'release-rels'       => $urlFields->getIncludeFlagForReleaseRelations(),
            'release-group-rels' => $urlFields->getIncludeFlagForReleaseGroupRelations(),
            'series-rels'        => $urlFields->getIncludeFlagForSeriesRelations(),
            'work-rels'          => $urlFields->getIncludeFlagForWorkRelations(),
        ];

        $result = $this->lookup(new EntityType(EntityType::URL), $mbid, $fields);

        return new URL($result);
    }

    /**
     * Looks up for a work and returns the result.
     *
     * @param MBID $mbid A Music Brainz Identifier (MBID) of a work
     *
     * @return Work
     */
    public function work(MBID $mbid, WorkFields $workFields): Work
    {
        $fields = [
            'artists'       => $workFields->getIncludeFlagForArtists(),
            'aliases'       => $workFields->getIncludeFlagForAliases(),
            'tags'          => $workFields->getIncludeFlagForTags(),
            'user-tags'     => $workFields->getIncludeFlagForUserTags(),
            'ratings'       => $workFields->getIncludeFlagForRatings(),
            'user-ratings'  => $workFields->getIncludeFlagForUserRatings(),
            'artist-rels'   => $workFields->getIncludeFlagForArtistRelations(),
            'label-rels'    => $workFields->getIncludeFlagForLabelRelations(),
            'recording-rels' => $workFields->getIncludeFlagForRecordingRelations(),
            'release-rels'  => $workFields->getIncludeFlagForReleaseRelations(),
            'release-group' => $workFields->getIncludeFlagForReleaseGroups(),
            'url-rels'      => $workFields->getIncludeFlagForURLRelations(),
            'work-rels'     => $workFields->getIncludeFlagForWorkRelations(),
            'annotations'   => $workFields->getIncludeFlagForAnnotation()
        ];

        $result = $this->lookup(new EntityType(EntityType::WORK), $mbid, $fields);

        return new Work($result);
    }

    /**
     * Looks up for an entity by performing a request to MusicBrainz webservice.
     *
     * @link http://musicbrainz.org/doc/XML_Web_Service
     *
     * @param EntityType $entityType   An entity type
     * @param MBID       $mbid         A MusicBrainz Identifier (MBID)
     * @param array      $includes     A list of include parameters
     * @param bool       $authRequired True, if user authentication is required
     *
     * @return array
     */
    private function lookup(EntityType $entityType, MBID $mbid, array $includes = [], bool $authRequired = false)
    {
        $includes = array_keys(array_filter($includes));

        $params = [
            'inc' => implode('+', $includes),
            'fmt' => 'json'
        ];

        $response = $this->httpAdapter->call(
            str_replace('_', '-', (string) $entityType) .
            '/' .
            (string) $mbid,
            $this->config,
            $params,
            $authRequired
        );

        return $response;
    }
}
