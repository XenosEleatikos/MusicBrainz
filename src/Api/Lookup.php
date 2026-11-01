<?php

declare(strict_types=1);

namespace MusicBrainz\Api;

use MusicBrainz\Config;
use MusicBrainz\Http\ApiClient;
use MusicBrainz\Supplement\Fields;
use MusicBrainz\Supplement\Lookup\AreaFields;
use MusicBrainz\Supplement\Lookup\ArtistFields;
use MusicBrainz\Supplement\Lookup\CollectionFields;
use MusicBrainz\Supplement\Lookup\EventFields;
use MusicBrainz\Supplement\Lookup\InstrumentFields;
use MusicBrainz\Supplement\Lookup\LabelFields;
use MusicBrainz\Supplement\Lookup\PlaceFields;
use MusicBrainz\Supplement\Lookup\RecordingFields;
use MusicBrainz\Supplement\Lookup\ReleaseFields;
use MusicBrainz\Supplement\Lookup\ReleaseGroupFields;
use MusicBrainz\Supplement\Lookup\SeriesFields;
use MusicBrainz\Supplement\Lookup\UrlFields;
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
 * @link https://musicbrainz.org/doc/MusicBrainz_API#Lookups
 */
final class Lookup
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
     * Constructs the lookup API.
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
     * Looks up for an area and returns the result.
     *
     * @param MBID       $mbid       A MusicBrainz Identifier (MBID) of an area
     * @param AreaFields $areaFields List of fields to be included in the response
     *
     * @return Area
     */
    public function area(MBID $mbid, AreaFields $areaFields): Area
    {
        $result = $this->lookup(EntityType::Area, $mbid, $areaFields);

        return Area::fromArray($result);
    }

    /**
     * Looks up for an artist and returns the result.
     *
     * @param MBID         $mbid         A MusicBrainz Identifier (MBID) of an artist
     * @param ArtistFields $artistFields List of fields to be included in the response
     * @return Artist
     */
    public function artist(MBID $mbid, ArtistFields $artistFields): Artist
    {
        $result = $this->lookup(EntityType::Artist, $mbid, $artistFields);

        return Artist::fromArray($result);
    }

    /**
     * Looks up for a collection and returns the result.
     *
     * @param MBID $mbid A MusicBrainz Identifier (MBID) of a collection
     *
     * @return Collection
     */
    public function collection(MBID $mbid): Collection
    {
        $result = $this->lookup(EntityType::Collection, $mbid, new CollectionFields());

        return Collection::fromArray($result);
    }

    /**
     * Looks up for an event and returns the result.
     *
     * @param MBID        $mbid        A MusicBrainz Identifier (MBID) of an event
     * @param EventFields $eventFields List of fields to be included in the response
     *
     * @return Event
     */
    public function event(MBID $mbid, EventFields $eventFields): Event
    {
        $result = $this->lookup(EntityType::Event, $mbid, $eventFields);

        return Event::fromArray($result);
    }

    /**
     * Looks up for an instrument and returns the result.
     *
     * @param MBID             $mbid             A MusicBrainz Identifier (MBID) of an instrument
     * @param InstrumentFields $instrumentFields List of fields to be included in the response
     *
     * @return Instrument
     */
    public function instrument(MBID $mbid, InstrumentFields $instrumentFields): Instrument
    {
        $result = $this->lookup(EntityType::Instrument, $mbid, $instrumentFields);

        return Instrument::fromArray($result);
    }

    /**
     * Looks up for a label and returns the result.
     *
     * @param MBID   $mbid A MusicBrainz Identifier (MBID) of a label
     * @param LabelFields $labelFields List of fields to be included in the response
     *
     * @return Label
     */
    public function label(MBID $mbid, LabelFields $labelFields): Label
    {
        $result = $this->lookup(EntityType::Label, $mbid, $labelFields);

        return Label::fromArray($result);
    }

    /**
     * Looks up for a place and returns the result.
     *
     * @param MBID        $mbid        A MusicBrainz Identifier (MBID) of a label
     * @param PlaceFields $placeFields List of fields to be included in the response
     *
     * @return Place
     */
    public function place(MBID $mbid, PlaceFields $placeFields): Place
    {
        $result = $this->lookup(EntityType::Place, $mbid, $placeFields);

        return Place::fromArray($result);
    }

    /**
     * Looks up for a recording and returns the result.
     *
     * @param MBID            $mbid            A MusicBrainz Identifier (MBID) of a recording
     * @param RecordingFields $recordingFields List of fields to be included in the response
     *
     * @return Recording
     */
    public function recording(MBID $mbid, RecordingFields $recordingFields): Recording
    {
        $result = $this->lookup(EntityType::Recording, $mbid, $recordingFields);

        return Recording::fromArray($result);
    }

    /**
     * Looks up for a release and returns the result.
     *
     * @param MBID          $mbid          A MusicBrainz Identifier (MBID) of a release
     * @param ReleaseFields $releaseFields List of fields to be included in the response
     *
     * @return Release
     */
    public function release(MBID $mbid, ReleaseFields $releaseFields): Release
    {
        $result = $this->lookup(EntityType::Release, $mbid, $releaseFields);

        return Release::fromArray($result);
    }

    /**
     * Looks up for a release group and returns the result.
     *
     * @param MBID               $mbid               A MusicBrainz Identifier (MBID) of a release
     * @param ReleaseGroupFields $releaseGroupFields List of fields to be included in the response
     *
     * @return ReleaseGroup
     */
    public function releaseGroup(MBID $mbid, ReleaseGroupFields $releaseGroupFields): ReleaseGroup
    {
        $result = $this->lookup(EntityType::ReleaseGroup, $mbid, $releaseGroupFields);

        return ReleaseGroup::fromArray($result);
    }

    /**
     * Looks up for an URL and returns the result.
     *
     * @param MBID         $mbid         A MusicBrainz Identifier (MBID) of a release
     * @param SeriesFields $seriesFields List of fields to be included in the response
     *
     * @return Series
     */
    public function series(MBID $mbid, SeriesFields $seriesFields): Series
    {
        $result = $this->lookup(EntityType::Series, $mbid, $seriesFields);

        return Series::fromArray($result);
    }

    /**
     * Looks up for an URL and returns the result.
     *
     * @param MBID         $mbid          A MusicBrainz Identifier (MBID) of a release
     * @param UrlFields $urlFields List of fields to be included in the response
     *
     * @return URL
     */
    public function url(MBID $mbid, UrlFields $urlFields): URL
    {
        $result = $this->lookup(EntityType::Url, $mbid, $urlFields);

        return URL::fromArray($result);
    }

    /**
     * Looks up for a work and returns the result.
     *
     * @param MBID   $mbid A MusicBrainz Identifier (MBID) of a work
     * @param WorkFields $workFields List of fields to be included in the response
     *
     * @return Work
     */
    public function work(MBID $mbid, WorkFields $workFields): Work
    {
        $result = $this->lookup(EntityType::Work, $mbid, $workFields);

        return Work::fromArray($result);
    }

    /**
     * Looks up for an entity by performing a request to the MusicBrainz web service.
     *
     * @link https://musicbrainz.org/doc/MusicBrainz_API
     *
     * @param EntityType $entityType An entity type
     * @param MBID       $mbid       A MusicBrainz Identifier (MBID)
     * @param Fields     $includes   A list of include parameters
     *
     * @return array<mixed, mixed>
     */
    private function lookup(EntityType $entityType, MBID $mbid, Fields $includes): array
    {
        $params = [
            'inc' => (string) $includes,
            'fmt' => 'json',
        ];

        return $this->apiClient->call(
            $entityType->path() . '/' . $mbid,
            $this->config,
            $params,
            str_contains((string) $includes, 'user-')
        );
    }
}
