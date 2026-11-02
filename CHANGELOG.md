# Changelog

All notable changes are documented here. The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
the versioning follows [Semantic Versioning](https://semver.org/).

## [Unreleased]

Known limitation: the logger is process-wide (the most recently created `MusicBrainz` instance that was given a logger wins).

Planned for 2.1: write access (tags, ratings, collection items), lookups by DiscID, ISRC and ISWC, the multi-URL
lookup.

## [2.0.0] - unreleased

A modernization of the library after a long break. **This release contains breaking changes**, see the migration
guide in the README.

### Changed (breaking)
- PHP 8.3 or newer is required.
- HTTP is done with any [PSR-18](https://www.php-fig.org/psr/psr-18/) client and a
  [PSR-17](https://www.php-fig.org/psr/psr-17/) request factory. The HTTP adapters (`Guzzle`, `Curl`, ...) and the
  dependency on Guzzle are gone.
- Digest authentication (user name and password) is gone, it is deprecated by MusicBrainz. Authenticated requests use an
  OAuth2 access token (`Config::setAccessToken()`).
- The value objects are `final readonly` classes with public typed properties instead of classes with getters
  (`$artist->name` instead of `getArtistName()`). Names are uniform (`name`, `title`, `sortName`), nested objects that
  the response does not contain are `null` instead of empty dummy objects, lists are plain arrays, `Page` and
  `SearchResult` are generic, `Page` and `RelationList` are immutable. They are built with `X::fromArray()`; the property traits
  and the per-entity list and page classes are gone.
- `Relation` and `RelationList` live in `MusicBrainz\Value`, with the other results. Relations are `Relation` objects (type name, id and class, direction, target entity, period, attributes, credits; those of a
  type the library does not know yet are kept with `type` null) in
  `$entity->relations`, a `RelationList` grouped by `->to(EntityType::Artist)`.
- `EntityType`, `Direction` and `DataQuality` are backed enums. All other quasi-enums are value objects with a `name`,
  an `id` (MBID) and a `kind()` returning a backed enum (`MediumFormat` (the format of a medium, 87 values, e.g. `DualDisc (CD side)`, `Microcassette`, `SD Card`), `CollectionType`, `ArtistType`/`ArtistTypeKind`, `Gender`/`GenderKind`,
  `ReleaseStatus`, `PrimaryReleaseType`, `SecondaryReleaseType`, `Packaging`, `AliasType`, `AreaType`, `LabelType`,
  `EventType`, `PlaceType`, `InstrumentType`, `SeriesType`, `WorkType`). A value MusicBrainz knows but the library does
  not is kept in `name` and logged as warning; `kind()` returns `null`.
- `ReleaseType`, `ReleaseTypeList` and `AbstractType` were removed, use `PrimaryReleaseType` and
  a list of `SecondaryReleaseType`.
- Browse relations are immutable and created with a static constructor of the entity you browse: `ReleaseRelation::artist($mbid)`
  instead of `(new ReleaseRelation())->artist($mbid)`, so they cannot exist half defined. `setEntityTypeRelease()` and
  `setEntityTypeReleaseGroup()` are now `release()` and `releaseGroup()`, `CollectionRelation::editor()` takes the user name of
  the editor (editors have no MBID). The query parameters are the enum `BrowseParameter`; `EntityType` contains only entities.
- The `add*()` methods of the search filters return the filter (`static`), so calls can be chained, instead of objects of the
  query builder AskLucy; the filter input classes (`Name`, `Count`, `Country`, `LabelCode`, ...) moved to
  `MusicBrainz\Filter\Value`, the results use plain scalars. `Relation\Type::getRelationName()` returns a string.
- `Relation::tryFromArray()`, `NamedType::fromKeys()` and the other factories that differ from `Parsable::fromArray()` have
  their own names; the entities implement `MusicBrainz\Value\Entity`.
- The small value objects the search filters take as input (`Name`, `MBID`, `Date`, `Count`, `Country`, `LabelCode`, ...)
  are `final readonly` with a public `value` and refuse impossible values with an `InvalidArgumentException`
  (negative counts, coordinates outside the earth, an invalid IPI, ...) instead of silently turning them into nothing.
  `Date` exposes `originalFormat` and `dateTime`; `LabelCode::withoutPrefix()` replaces
  `getLabelCodeWithoutLcPrefix()`. The marker interfaces `Value` and `Expression` are gone.
- Unused list classes were removed (`ArtistList`, `AreaList`, `WorkList`, ...).
- The wrapper classes around single scalars that results contained (`Score`, `RatingValue`, `RatingVotes`, `JoinPhrase`, `Cancelled`,
  `Resource`, `Time`, `TimeStamp`, `Format`, ...) are gone: the properties are plain scalars, `MediumFormat` replaces `Format`.
  `__toString()` is gone from the entities and most other results (it stays on `MBID`, `Date`, the types, `Alias`, `Collection`,
  `Genre` and `Tag`), use their properties.
- `PageFilter` is `final readonly`: it takes limit and offset in its constructor, `getLimit()`, `getOffset()`, `setLimit()` and
  `setOffset()` are gone (read `$pageFilter->limit` and `->offset`). The `getIncludeFlagFor...()` methods of the fields classes
  (`inc` parameters) are gone, the classes only offer the chainable `include...()` methods.
- `UrlRelation`, the browse `UrlFields` and `DiscIdFields` are removed: no API method used them. `getEntityId()` and `getEntityType()`
  of the browse relations are gone, the relation carries its `BrowseParameter` and its value.

### Added
- Recordings can be searched by the number of tracks on any medium (`addNumberOfTracksOnAnyMedium()`, field `tracks`) and on
  any release (`addNumberOfTracksOnAnyRelease()`, `tracksrelease`); events can be browsed by events.
- The search filters follow one naming scheme: `add<Field>`, with `...WithAccents` for the variant that is sensitive to
  diacritics. 1.x names changed: `addArtistNameWithoutAccents()` is `addArtistName()` (likewise for events, instruments,
  labels, recordings, release groups, series, works), `addReleaseNameWithAccent()` is `addReleaseNameWithAccents()`,
  `addASIN()` is `addAsin()`, `addDisambiguationComment()` is `addDisambiguation()`, `addTitleComment()` is `addTitle()`,
  `addIsrcCode()`/`addIsniCode()`/`addIpiCode()` are `addIsrc()`/`addIsni()`/`addIpi()`, `addSortNameWithAccents()` is
  `addSortName()` (it always searched `sortname`). The static methods that return the field names are `@internal`.
- `Config` refuses a user agent or token that cannot be an HTTP header value; MBIDs are normalized to lower case and must not
  carry trailing characters; a lookup whose answer is no entity (no `id`) is a `ResponseException`; a relation list that is an
  object instead of a list no longer crashes the parser.
- Search criteria are combined with AND, so every criterion narrows the result (a juxtaposition of criteria means OR to the
  web service); `$filter->matchAny()` asks for OR. Whatever an application passes to a filter either becomes part of a valid
  query or throws a `MusicBrainz\InvalidArgumentException`; `ended:false` and `video:false` can be searched, an address is
  searched as a phrase.
- Exceptions: `MusicBrainz\ExceptionInterface` is implemented by everything the library throws on purpose. `ApiException` (HTTP
  status as code), `TransportException`, `ResponseException` and `ConfigurationException` extend `MusicBrainz\Exception` for
  everything that goes wrong with a request; `InvalidArgumentException` (an SPL exception) signals invalid input and is no
  longer an `Exception`, so that a `catch` around a request does not swallow programming errors. `Config` validates its
  settings, and the library logs a warning, once, if the default user agent is used.
- A section in the README that thanks the authors the library builds on.
- Input is validated: an invalid MBID or date, an empty text value, a bad page filter or an empty search filter throw a
  `MusicBrainz\InvalidArgumentException`. What the web service delivers is read tolerantly: an invalid id or date, a
  wrongly typed element, or a missing list or count is logged and skipped instead of crashing the response or vanishing
  silently.
- The entry point, the API classes, `Config`, the search filters and the fields classes are `final`; the plumbing (`fromArray()` factories, helpers, the HTTP
  client, the map of relationship types) is marked `@internal`.
- Search for events, instruments, series and URLs. Every search filter offers exactly the fields the documentation of the
  search lists (a test compares them), including `alias`, `tag`, `isni`, the `*accent` variants and `release_count`.
- Genres, tags and ratings on all entities (`genres`, `tags`, `rating`), and the same for the authenticated user
  (`userGenres`, `userTags`, `userRating`). Annotations, and the recordings, works and releases an artist or label was
  requested with, are no longer dropped.
- Relations keep their own data: period, attributes, credits and ordering (`begin`, `attributes`, `sourceCredit`, ...),
  including the relations of works.
- Pregap and data tracks of media, Cover Art Archive information of releases, setlists of events, ISRCs of recordings.
- 82 relationship types that were missing, including everything that involves genres; relations to genres.
- Enum cases the documentation lists but the library lacked: `LabelTypeKind::Broadcaster`, `PlaceTypeKind::Amphitheatre`,
  `EducationalInstitution` and `Park`, `InstrumentTypeKind::Family`, `ReleaseStatusKind::Expunged`, `AliasTypeKind::BrandName`
  and the packagings `ClamshellCase`, `Digibook`, `Digifile`, `Longbox`, `MetalTin`, `SnapPack` and `SuperJewelBox`.
- Rate limiting (one request per second) and retries on HTTP 503, configurable.
- Test infrastructure: `bin/record-fixtures` records real responses, the unit tests replay them offline.
- CI for PHP 8.3, 8.4 and 8.5, PHPStan level 9, a coverage gate.

### Fixed
- Search results for labels, release groups, works, tags and CD stubs had no data.
- The label info of releases was always empty.
- Relations from labels to artists, and from areas to areas, were dropped.
- Browsing by release group sent a wrong parameter, the place search had no name field.
- `begin-area`/`end-area`, `label-code` as integer, coordinates as strings, integer ratings are parsed.
- The include parameters of all lookup and browse requests (browsing areas, instruments and series excepted, which needs a
  collection and with it a token) are exactly those the web service accepts (derived from the service itself and kept in
  sync by a test): `releases` for releases, `artists` and `release-groups` for works and
  `discids` or `media` for labels without releases were offered but rejected; the relationship includes for every pair of
  entities, `genre-rels`, and the combinations that need `releases` or `recordings` (`media`, `discids`, `isrcs`,
  `various-artists`) were missing.
- Deprecations of PHP 8.4 (implicitly nullable parameters).
- Search fields that did not exist at MusicBrainz: places by `lat`/`long` (not `latitude`/`longitude`), areas by
  `iso1`/`iso2`/`iso3`, artists by `endarea` (was `area`), releases by `discidsmedium` (was `discids`), CD stubs by
  `tracks`. `WorkFilter` (ISRC) and `RecordingFilter` (tracks on a medium) no longer offer fields their index lacks.
- `getRelationName()` of 13 relationship types returned a name that differs from the official one (for example
  "named after artist", "position at", "authorship"); the names and descriptions are those of musicbrainz.org now.
- `WorkTypeKind::Tude` is `WorkTypeKind::Etude`.
- Links to the documentation that were redirected or pointed to a missing anchor.
