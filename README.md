# MusicBrainz API Client
This project contains an easy to use PHP API client for the [MusicBrainz JSON web service](https://musicbrainz.org/doc/Development/JSON_Web_Service).

## Contents
- [Installation](#installation)
    - [Install with Git](#install-with-git)
    - [Install with Composer](#install-with-composer)
- [Set up](#set-up)
    - [HTTP client](#http-client)
    - [Logger](#logger)
    - [User agent and rate limit](#user-agent-and-rate-limit)
    - [Authentication](#authentication)
- [Usage](#usage)
    - [Search Requests](#search-requests)
    - [Lookup Requests](#lookup-requests)
    - [Browse Requests](#browse-requests)

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
method taking a specific filter object and a page filter for pagination. The return value will be a specific
list object containing basic information about the matching entities. For more information you have to perform
a [lookup request](#lookup-requests) with the MusicBrainz Identifier (MBID) of the entity.

The following example search for the artist named "Tom Waits" and limits the result list to the top match.

```php
<?php
use MusicBrainz\Filter\PageFilter;
use MusicBrainz\Filter\Search\ArtistFilter;
use MusicBrainz\Value\Name;

$artistFilter = new ArtistFilter;
$artistFilter->addArtistNameWithoutAccents(new Name('Tom Waits'));
$pageFilter = new PageFilter(0, 1);

$artistList = $this->musicBrainz->api()->search()->artist($artistFilter, $pageFilter);
```

### Lookup Requests
If you have the MusicBrainz Identifier (MBID) of an entity (through a [search request](#search-requests)), you
can get more information about it by performing a lookup request. For each of the core entities there is a
specific lookup method. As first argument you have to pass the MBID. The second argument is a list of additional fields
the response object should contain.

The followig example looks up for the artist with MBID c3aeb863-7b26-4388-94e8-5a240f2be21b (who is Tom Waits), and
requests to append information about his his recordings and works to the response.

```php
<?php
use MusicBrainz\Supplement\Lookup\ArtistFields;
use MusicBrainz\Value\MBID;

$fields = (new ArtistFields)
    ->includeRecordings()
    ->includeWorks();

self::$artist = $this->musicBrainz->api()->lookup()->artist(
    new MBID('c3aeb863-7b26-4388-94e8-5a240f2be21b'),
    $fields
);
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
use MusicBrainz\Supplement\Browse\EventFields;

$eventRelation = (new EventRelation)
    ->artist(new MBID('4aae17a7-9f0c-487b-b60e-f8eafb410b1d'));
$eventFields = (new EventFields)
    ->includeTags();
$pageFilter = new PageFilter(0, 5);

$eventList = $musicBrainz->api()->browse()->event($eventRelation, $eventFields, $pageFilter);
```
