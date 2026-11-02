# MusicBrainz API Client
A typed PHP API client for the [MusicBrainz JSON web service](https://musicbrainz.org/doc/MusicBrainz_API):
search, lookup and browse requests for the core entities, including genres, tags, ratings and relations. The library is
read-only. Requirements: PHP 8.3 or newer, any PSR-18 HTTP client.

## Contents
- [Installation](#installation)
    - [Install with Git](#install-with-git)
    - [Install with Composer](#install-with-composer)
- [Set up](#set-up)
    - [HTTP client](#http-client)
    - [Logger](#logger)
    - [User agent and rate limit](#user-agent-and-rate-limit)
    - [Authentication](#authentication)
    - [Custom API Path](#custom-api-path)
- [Usage](#usage)
    - [Search Requests](#search-requests)
    - [Lookup Requests](#lookup-requests)
    - [Browse Requests](#browse-requests)
    - [Value objects](#value-objects)
    - [Types and unknown values](#types-and-unknown-values)
    - [Relations](#relations)
    - [Errors](#errors)
- [Upgrading from 1.x](#upgrading-from-1x)
- [Development](#development)

## Installation
### Install with Git
```bash
git clone https://github.com/XenosEleatikos/MusicBrainz.git
```

### Install with Composer
This project is available at [Packagist](https://packagist.org): https://packagist.org/packages/xenos/musicbrainz.

You can use it in your project with the following command:
```bash
composer require xenos/musicbrainz
```

## Set up

### HTTP client
The library requires **PHP 8.3+** and works with any [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client together
with a [PSR-17](https://www.php-fig.org/psr/psr-17/) request factory. Example with the Symfony HTTP client and Nyholm's
PSR-7 implementation:

```php
<?php
use MusicBrainz\MusicBrainz;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\HttpClient\Psr18Client;

$musicBrainz = new MusicBrainz(new Psr18Client(), new Psr17Factory());
```

```bash
composer require symfony/http-client nyholm/psr7
```

Guzzle (`guzzlehttp/guzzle` with `guzzlehttp/psr7`) or any other PSR-18 client works the same way.

### Logger
Optionally, you may set any [PSR-3](http://www.php-fig.org/psr/psr-3/) logger as third constructor argument:

```php
<?php
$musicBrainz = new MusicBrainz(new Psr18Client(), new Psr17Factory(), $logger);
```

The logger receives warnings about data the library does not know yet (a new type, an unknown relationship type) and
unexpected API behavior. Note that the logger is process-wide: value objects are built from plain arrays and log through
`MusicBrainz::log()`, so the logger of the most recently created `MusicBrainz` instance that was given a logger is used.

### User agent and rate limit
MusicBrainz requires a meaningful user agent and allows one request per second. The client throttles requests
automatically and retries on HTTP 503. Please set the name and contact of your application:

```php
<?php
$musicBrainz->config()->setUserAgent('MyApp/1.0 ( https://example.com/contact )');
```

### Authentication
Requests for ``user-tags``, ``user-ratings``, ``user-genres`` and private collections require an
[OAuth2](https://musicbrainz.org/doc/Development/OAuth2) access token. (HTTP digest authentication is deprecated by
MusicBrainz and not supported.)

```php
<?php
$musicBrainz->config()->setAccessToken('my-oauth2-access-token');
```

The library only sends the token. Obtaining and renewing it is up to your application:

1. **Register your application** at <https://musicbrainz.org/account/applications> (client ID, client secret, redirect URI).
2. **Request the scopes you need.** `tag`, `rating` and `collection` give access to the private tags, ratings and collections
   of the user (reading and modifying); `profile` and `email` return profile data. There are no read-only variants.
3. **Run the OAuth2 authorization code flow** with any OAuth2 client. The endpoints are
   `https://musicbrainz.org/oauth2/authorize` and `https://musicbrainz.org/oauth2/token`. Pass `access_type=offline` to get a
   refresh token.
4. **Renew the token.** Access tokens are short-lived (about one hour), refresh tokens stay valid until the user revokes them.
   An expired token makes a request fail with an `ApiException` (HTTP 401): refresh the token and call `setAccessToken()` again.

A sketch with [league/oauth2-client](https://github.com/thephpleague/oauth2-client) (not a dependency of this library):

```php
<?php
use League\OAuth2\Client\Provider\GenericProvider;

$provider = new GenericProvider([
    'clientId'                => 'my-client-id',
    'clientSecret'            => 'my-client-secret',
    'redirectUri'             => 'https://example.com/callback',
    'urlAuthorize'            => 'https://musicbrainz.org/oauth2/authorize',
    'urlAccessToken'          => 'https://musicbrainz.org/oauth2/token',
    'urlResourceOwnerDetails' => 'https://musicbrainz.org/oauth2/userinfo',
    'scopes'                  => ['collection'],
    'scopeSeparator'          => ' ',
]);

// 1. Send the user to $provider->getAuthorizationUrl(['access_type' => 'offline'])
// 2. On the redirect back, exchange the code:
$token = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);
// Store $token->getRefreshToken(), then:
$musicBrainz->config()->setAccessToken($token->getToken());

// Later, when the access token has expired:
$token = $provider->getAccessToken('refresh_token', ['refresh_token' => $storedRefreshToken]);
$musicBrainz->config()->setAccessToken($token->getToken());
```

The library does not run this flow itself, and it does not refresh tokens automatically.

### Custom API Path
By default, all requests are executed against the MusicBrainz API at
[https://musicbrainz.org/ws/2](https://musicbrainz.org/ws/2). You can set another base path (e. g. for your own MusicBrainz
installation) as follows:

```php
<?php
/** @var \MusicBrainz\MusicBrainz $musicBrainz*/
$musicBrainz->config()
    ->setApiUrl('https://example.com/ws/2');
```

## Usage

### Search Requests
The search API provides methods to search for the MusicBrainz
[core entities](https://musicbrainz.org/doc/MusicBrainz_Entity). For each of these entities there is a search
method taking a specific filter object and a page filter for pagination. The return value is a `Page` containing
basic information about the matching entities. For more information you have to perform
a [lookup request](#lookup-requests) with the MusicBrainz Identifier (MBID) of the entity.

Several criteria of a filter are combined with AND: each one narrows the result (use `$filter->matchAny()` for OR).

The following example searches for the artist named "Tom Waits" and limits the result list to the top match. The result
is a `Page` of `SearchResult` objects, each with the matching `entity` and its `score` (0 to 100).

```php
<?php
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Filter\Value\Name;

$artistFilter = new ArtistFilter;
$artistFilter->addArtistName(new Name('Tom Waits'));
$pageFilter = new PageFilter(0, 1);

$artistList = $musicBrainz->api()->search()->artist($artistFilter, $pageFilter);

echo $artistList->totalCount, ' matches', PHP_EOL;       // all matches, not only this page
foreach ($artistList as $result) {                        // a Page is iterable, countable and read-only
    echo $result->score, ' ', $result->entity->name, PHP_EOL;
}
```

### Lookup Requests
If you have the MusicBrainz Identifier (MBID) of an entity (through a [search request](#search-requests)), you
can get more information about it by performing a lookup request. For each of the core entities there is a
specific lookup method. As first argument you have to pass the MBID. The second argument is a list of additional fields
the response object should contain.

The following example looks up for the artist with MBID c3aeb863-7b26-4388-94e8-5a240f2be21b (who is Tom Waits), and
requests to append information about his recordings and works to the response.

```php
<?php
use MusicBrainz\Supplement\Lookup\ArtistFields;
use MusicBrainz\Value\MBID;

$fields = (new ArtistFields)
    ->includeRecordings()
    ->includeWorks();

$artist = $musicBrainz->api()->lookup()->artist(
    new MBID('c3aeb863-7b26-4388-94e8-5a240f2be21b'),
    $fields
);

echo $artist->name, ' (', $artist->lifeSpan?->begin, ')', PHP_EOL;
foreach ($artist->recordings as $recording) {
    echo $recording->title, PHP_EOL;
}
```

### Browse Requests
Browse requests are a direct lookup of all the entities directly linked to another entity with a given MusicBrainz
Identifier (MBID).

The following example looks up for all events directly linked to the artist with the MBID
c3aeb863-7b26-4388-94e8-5a240f2be21b (who is Tom Waits). In analogy to normal [lookup requests](#lookup-requests)
additional fields may be specified for the response, and a page filter may be added for pagination.

```php
<?php
use MusicBrainz\Filter\Browse\Relation\Entity\EventRelation;
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Supplement\Browse\EventFields;
use MusicBrainz\Value\MBID;

$eventRelation = EventRelation::artist(new MBID('c3aeb863-7b26-4388-94e8-5a240f2be21b'));
$eventFields = (new EventFields)
    ->includeTags();
$pageFilter = new PageFilter(0, 5);

$eventList = $musicBrainz->api()->browse()->event($eventRelation, $eventFields, $pageFilter);

foreach ($eventList as $event) {
    echo $event->name, ' ', $event->lifeSpan?->begin, PHP_EOL;
}
```

### Value objects
All results are immutable value objects (`final readonly` classes) with public, typed properties; there are no getters
and setters. Data the response does not contain is `null` (a nested object such as `$artist->area`, a date, a type) or
empty (`''` for names, `[]` for lists), never a dummy object. Dates are `Date` objects that keep the precision the
database has ("1969", "1969-09", "1969-09-26"). The classes are built from the decoded JSON with `X::fromArray()`;
that factory is not meant to be called by applications.

The rule for missing data: a name, title or disambiguation the web service always delivers is a `string` (`''` if empty);
anything it may leave out is nullable (`?string`, `?Date`, `?Area`, ...); lists are never null. The entities implement the
marker interface `MusicBrainz\Value\Entity`.

### Types and unknown values
Types, genders, statuses etc. are value objects with the name as MusicBrainz delivers it, the MBID of the type, and a
`kind()` returning an enum for the values the library knows:

```php
<?php
use MusicBrainz\Value\ArtistTypeKind;

$type = $artist->type;                 // null if the response has no type
$type->name;                           // "Person"
(string) $type->id;                    // "b6e035f4-3ce9-331c-97df-83397230b0df"
ArtistTypeKind::Person === $type->kind();
```

MusicBrainz maintains these lists in its database and extends them from time to time. A value the library does not know
yet is kept in `name`, `kind()` returns `null`, and a warning is sent to your logger.

### Relations
Entities that were requested with relationship includes (e.g. `includeArtistRelations()`) have a `RelationList` in
`$entity->relations` (`null` if relations were not requested). Every relation knows its type (`typeName`, `typeId`, and `type`, the class of the
relationship type, which is `null` for a type the library does not know yet), its direction, its target entity, its period,
its attributes and its credits:

```php
<?php
use MusicBrainz\Value\EntityType;

foreach ($artist->relations?->to(EntityType::Artist) ?? [] as $relation) {
    echo $relation->typeName, ': ', $relation->target->name, PHP_EOL;
    echo $relation->begin, ' - ', $relation->end, ' ', implode(', ', $relation->attributes), PHP_EOL;
}
```

### Errors
Everything the library throws on purpose about requests and input implements `MusicBrainz\ExceptionInterface`. (Only misuse of
read-only objects, such as writing to a `Page`, throws an SPL `LogicException` or `OutOfRangeException`.)

- `MusicBrainz\ApiException`: the web service answered with an HTTP error; the code is the HTTP status (404 for an unknown
  MBID, 401 for a missing or invalid token). Responses with HTTP 503 are retried automatically, see
  `Config::setMaxRetries()`.
- `MusicBrainz\TransportException`: the HTTP client failed (no connection, timeout).
- `MusicBrainz\ResponseException`: the answer was not the expected JSON.
- `MusicBrainz\ConfigurationException`: no user agent, or a token is needed and none is set.

These extend `MusicBrainz\Exception`. `MusicBrainz\InvalidArgumentException` (an SPL `InvalidArgumentException`) signals invalid
input such as an MBID that is no UUID; it is a bug in the calling code and not an `Exception`.

## Stability
The public API is what this readme describes: the `MusicBrainz` entry point and its `Config`, the lookup, browse and search
methods with their filters, fields and page filter, the value objects with their public properties, and the exceptions.
Everything marked `@internal` (the `fromArray()` factories, the HTTP client, the helpers, the map of relationship types, the
static methods of the filters that return Lucene field names) may change in a minor release. The class hierarchy of the
relationship types mirrors MusicBrainz and may change in minor releases too: compare relationships by `typeId` (the
MBID), which is stable. New cases of the enums (types, statuses, formats) may be added in minor releases. Results and browse relations are immutable;
search filters and fields (`inc` parameters) are mutable builders that you fill with chained calls. Result classes, the API classes, filters and fields classes are `final`.

## Upgrading from 1.x
Version 2 contains breaking changes, the full list is in the [changelog](CHANGELOG.md). The most important ones:

1. **PHP 8.3+ and PSR-18.** Replace the HTTP adapters by a PSR-18 client and a PSR-17 request factory:
   ```php
   // 1.x:  new MusicBrainz(new GuzzleAdapter(...), ...)
   // 2.x:
   $musicBrainz = new MusicBrainz(new Psr18Client(), new Psr17Factory(), $logger);
   ```
2. **Authentication.** User name and password (digest authentication) are gone. Use an OAuth2 access token:
   `$musicBrainz->config()->setAccessToken('...')`.
3. **User agent.** Set a meaningful one: `$musicBrainz->config()->setUserAgent('MyApp/1.0 ( https://example.org )')`.
4. **No getters.** Results are readonly value objects with public properties: `$artist->name` instead of
   `$artist->getArtistName()`, `$release->title`, `$page->totalCount`, `$searchResult->entity`. All names are uniform
   (`name`, `title`, `sortName`, `disambiguation`). Absent nested objects are `null`; lists are plain arrays; `Page` is
   iterable and read-only. Relations are `Relation` objects in `$entity->relations` (see [Relations](#relations)).
5. **Enums and types.** `EntityType`, `Direction` and `DataQuality` are enums (`EntityType::ReleaseGroup`). Types like
   `ArtistType` or `Gender` have a `kind()` returning an enum (`ArtistTypeKind::Person`), see
   [Types and unknown values](#types-and-unknown-values). `ReleaseType`/`ReleaseTypeList` are replaced by
   `PrimaryReleaseType` and a list of `SecondaryReleaseType`.
6. **Browse filters.** `setEntityTypeRelease()`/`setEntityTypeReleaseGroup()` are now `release()`/`releaseGroup()`;
   `CollectionRelation::editor()` takes the user name. Browse relations are immutable objects created with a static
   constructor: `ReleaseRelation::artist($mbid)` instead of `(new ReleaseRelation())->artist($mbid)`.

## Development
See [CONTRIBUTING.md](CONTRIBUTING.md). The unit tests run offline against real, recorded responses of the web service.

## History and acknowledgements
This library stands on the shoulders of others, and I am grateful for their work:

- **Jeff Sherlock** started it in 2010, as one of the first PHP clients for the MusicBrainz web service.
- **Mike Almond** took it over in 2013 and maintained and extended it for years. Without that foundation, this project
  would not exist.
- **Chris Dawson**, **Chris Boden**, **Chris Roberts**, **Jbekker**, **shrddr**, **Afterster**, **Daniel Maly**, **Nic**
  and **papposilene** contributed fixes and features between 2012 and 2019.
- **Roland Dalmulder** added relationship types and fixes in 2023.

Until April 2013 the project was licensed under the GPL version 2; Mike Almond changed the license to MIT then, and it has
been MIT since.

Since 2017 the library is maintained by **Christoph Hochholzer**. Version 2.0 is a complete rewrite, but it builds on what
the people above made, and the history of this repository keeps their contributions (the license file keeps the copyright notice of Mike Almond,
see [LICENSE.md](LICENSE.md)).
