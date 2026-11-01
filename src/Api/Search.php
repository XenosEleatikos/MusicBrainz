<?php

declare(strict_types=1);

namespace MusicBrainz\Api;

use MusicBrainz\Value\Annotation;
use MusicBrainz\Value\Area;
use MusicBrainz\Value\Artist;
use MusicBrainz\Value\CdStub;
use MusicBrainz\Value\Event;
use MusicBrainz\Value\Instrument;
use MusicBrainz\Value\Series;
use MusicBrainz\Value\URL;
use MusicBrainz\Value\Label;
use MusicBrainz\Value\Place;
use MusicBrainz\Value\Recording;
use MusicBrainz\Value\Release;
use MusicBrainz\Value\ReleaseGroup;
use MusicBrainz\Value\Tag;
use MusicBrainz\Value\Work;
use MusicBrainz\Value\Page;
use MusicBrainz\Config;
use MusicBrainz\Exception;
use MusicBrainz\InvalidArgumentException;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Search\AbstractFilter;
use MusicBrainz\Filter\Search\AnnotationFilter;
use MusicBrainz\Filter\Search\AreaFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Filter\Search\CdStubFilter;
use MusicBrainz\Filter\Search\EventFilter;
use MusicBrainz\Filter\Search\InstrumentFilter;
use MusicBrainz\Filter\Search\SeriesFilter;
use MusicBrainz\Filter\Search\UrlFilter;
use MusicBrainz\Filter\Search\LabelFilter;
use MusicBrainz\Filter\Search\PlaceFilter;
use MusicBrainz\Filter\Search\RecordingFilter;
use MusicBrainz\Filter\Search\ReleaseFilter;
use MusicBrainz\Filter\Search\ReleaseGroupFilter;
use MusicBrainz\Filter\Search\TagFilter;
use MusicBrainz\Filter\Search\WorkFilter;
use MusicBrainz\Http\ApiClient;
use MusicBrainz\Value\SearchResult;

/**
 * The search API provides methods for searching entities based on the parameters supplied in the filter objects.
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search
 */
class Search
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
     * Constructs the search API.
     *
     * @param ApiClient $apiClient The API client
     * @param Config    $config    The API client configuration
     */
    public function __construct(ApiClient $apiClient, Config $config)
    {
        $this->apiClient = $apiClient;
        $this->config = $config;
    }

    /**
     * Search for annotations and returns the result.
     *
     * @param AnnotationFilter $annotationFilter An annotation filter
     * @param PageFilter       $pageFilter       A page filter
     *
     * @return Page<SearchResult<Annotation>>
     *
     * @throws Exception
     */
    public function annotation(AnnotationFilter $annotationFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($annotationFilter, $pageFilter);
        $response = $this->apiClient->call('annotation/', $this->config, $params, false);

        return Page::search($response, 'annotation', Annotation::class);
    }

    /**
     * Searches for areas and returns the result.
     *
     * @param AreaFilter $areaFilter An area filter
     * @param PageFilter $pageFilter A page filter
     *
     * @return Page<SearchResult<Area>>
     *
     * @throws Exception
     */
    public function area(AreaFilter $areaFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($areaFilter, $pageFilter);
        $response = $this->apiClient->call('area/', $this->config, $params, false);

        return Page::search($response, 'area', Area::class);
    }

    /**
     * Searches for artists and returns the result.
     *
     * @param ArtistFilter $artistFilter An artist filter
     * @param PageFilter   $pageFilter   A page filter
     *
     * @return Page<SearchResult<Artist>>
     *
     * @throws Exception
     */
    public function artist(ArtistFilter $artistFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($artistFilter, $pageFilter);
        $response = $this->apiClient->call('artist/', $this->config, $params);

        return Page::search($response, 'artist', Artist::class);
    }

    /**
     * Searches for CD stubs and returns the result.
     *
     * @param CdStubFilter $cdStubFilter A CD stub filter
     * @param PageFilter   $pageFilter   A page filter
     *
     * @return Page<SearchResult<CdStub>>
     *
     * @throws Exception
     */
    public function cdStub(CdStubFilter $cdStubFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($cdStubFilter, $pageFilter);
        $response = $this->apiClient->call('cdstub/', $this->config, $params);

        return Page::search($response, 'cdstub', CdStub::class);
    }

    /**
     * Searches for events and returns the result.
     *
     * @param EventFilter $eventFilter A filter for events
     * @param PageFilter            $pageFilter A page filter
     *
     * @return Page<SearchResult<Event>>
     *
     * @throws Exception
     */
    public function event(EventFilter $eventFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($eventFilter, $pageFilter);
        $response = $this->apiClient->call('event/', $this->config, $params, false);

        return Page::search($response, 'event', Event::class);
    }

    /**
     * Searches for instruments and returns the result.
     *
     * @param InstrumentFilter $instrumentFilter A filter for instruments
     * @param PageFilter                 $pageFilter A page filter
     *
     * @return Page<SearchResult<Instrument>>
     *
     * @throws Exception
     */
    public function instrument(InstrumentFilter $instrumentFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($instrumentFilter, $pageFilter);
        $response = $this->apiClient->call('instrument/', $this->config, $params, false);

        return Page::search($response, 'instrument', Instrument::class);
    }

    /**
     * Searches for series and returns the result.
     *
     * @param SeriesFilter $seriesFilter A filter for series
     * @param PageFilter             $pageFilter A page filter
     *
     * @return Page<SearchResult<Series>>
     *
     * @throws Exception
     */
    public function series(SeriesFilter $seriesFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($seriesFilter, $pageFilter);
        $response = $this->apiClient->call('series/', $this->config, $params, false);

        return Page::search($response, 'series', Series::class);
    }

    /**
     * Searches for URLs and returns the result.
     *
     * @param UrlFilter $urlFilter A filter for URLs
     * @param PageFilter          $pageFilter A page filter
     *
     * @return Page<SearchResult<URL>>
     *
     * @throws Exception
     */
    public function url(UrlFilter $urlFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($urlFilter, $pageFilter);
        $response = $this->apiClient->call('url/', $this->config, $params, false);

        return Page::search($response, 'url', URL::class);
    }

    /**
     * Searches for labels and returns the result.
     *
     * @param LabelFilter $labelFilter A label filter
     * @param PageFilter  $pageFilter  A page filter
     *
     * @return Page<SearchResult<Label>>
     *
     * @throws Exception
     */
    public function label(LabelFilter $labelFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($labelFilter, $pageFilter);
        $response = $this->apiClient->call('label/', $this->config, $params);

        return Page::search($response, 'label', Label::class);
    }

    /**
     * Searches for places and returns the result.
     *
     * @param PlaceFilter $placeFilter A place filter
     * @param PageFilter  $pageFilter  A page filter
     *
     * @return Page<SearchResult<Place>>
     *
     * @throws Exception
     */
    public function place(PlaceFilter $placeFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($placeFilter, $pageFilter);
        $response = $this->apiClient->call('place/', $this->config, $params);

        return Page::search($response, 'place', Place::class);
    }

    /**
     * Searches for recording and returns the result.
     *
     * @param RecordingFilter $recordingFilter A recording filter
     * @param PageFilter      $pageFilter      A page filter
     *
     * @return Page<SearchResult<Recording>>
     *
     * @throws Exception
     */
    public function recording(RecordingFilter $recordingFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($recordingFilter, $pageFilter);
        $response = $this->apiClient->call('recording/', $this->config, $params);

        return Page::search($response, 'recording', Recording::class);
    }

    /**
     * Searches for releases and returns the result.
     *
     * @param ReleaseFilter $releaseFilter A release group filter
     * @param PageFilter    $pageFilter    A page filter
     *
     * @return Page<SearchResult<Release>>
     *
     * @throws Exception
     */
    public function release(ReleaseFilter $releaseFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($releaseFilter, $pageFilter);
        $response = $this->apiClient->call('release/', $this->config, $params);

        return Page::search($response, 'release', Release::class);
    }

    /**
     * Searches for release groups and returns the result.
     *
     * @param ReleaseGroupFilter $releaseGroupFilter A release group filter
     * @param PageFilter         $pageFilter         A page filter
     *
     * @return Page<SearchResult<ReleaseGroup>>
     *
     * @throws Exception
     */
    public function releaseGroup(ReleaseGroupFilter $releaseGroupFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($releaseGroupFilter, $pageFilter);
        $response = $this->apiClient->call('release-group/', $this->config, $params);

        return Page::search($response, 'release-group', ReleaseGroup::class);
    }

    /**
     * Searches for tags and returns the result.
     *
     * @param TagFilter  $tagFilter  A tag filter
     * @param PageFilter $pageFilter A page filter
     *
     * @return Page<SearchResult<Tag>>
     *
     * @throws Exception
     */
    public function tag(TagFilter $tagFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($tagFilter, $pageFilter);
        $response = $this->apiClient->call('tag/', $this->config, $params);

        return Page::search($response, 'tag', Tag::class);
    }

    /**
     * Searches for works and returns the result.
     *
     * @param WorkFilter $workFilter A work filter
     * @param PageFilter $pageFilter A page filter
     *
     * @return Page<SearchResult<Work>>
     *
     * @throws Exception
     */
    public function work(WorkFilter $workFilter, PageFilter $pageFilter): Page
    {
        $params   = $this->getParameters($workFilter, $pageFilter);
        $response = $this->apiClient->call('work/', $this->config, $params, false);

        return Page::search($response, 'work', Work::class);
    }

    /**
     * Returns a list of parameters.
     *
     * @param AbstractFilter $searchFilter A search filter
     * @param PageFilter     $pageFilter   A page filter
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    private function getParameters(AbstractFilter $searchFilter, PageFilter $pageFilter): array
    {
        if ('' === (string) $searchFilter) {
            throw new InvalidArgumentException('The filter needs at least one argument to create a query.');
        }

        return [
            'limit'  => $pageFilter->limit,
            'offset' => $pageFilter->offset,
            'fmt'    => 'json',
            'query'  => (string) $searchFilter,
        ];
    }
}
