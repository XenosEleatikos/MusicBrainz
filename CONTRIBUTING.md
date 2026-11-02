# Contributing

Thank you for helping. The library is a typed, read-only client for the [MusicBrainz JSON web service](https://musicbrainz.org/doc/MusicBrainz_API).

## Setup

PHP 8.3 or newer and Composer are needed.

```bash
composer install
composer ci          # code style, static analysis (PHPStan level 9) and the unit tests with a coverage gate
```

Single steps: `composer test`, `composer stan`, `composer cs` (fixes the style), `composer cs:check`.

## How the tests work

The unit tests run **offline**. They replay real responses of the web service, recorded in `tests/Fixtures/recorded`,
through a PSR-18 client (`tests/Support/ReplayHttpClient.php`):

| Test | Purpose |
|------|---------|
| `tests/unit/Api/LookupTest`, `PageTest`, `ErrorTest` | Every recorded lookup, browse and search response must be mirrored by the value objects, including nested objects and relations. `tests/Support/EntityAssertions.php` holds an explicit table per entity type: every JSON key must be mapped to a property or listed as deliberately not mapped, so data the library drops fails the test. |
| `tests/unit/Contract/ScenarioTest` | The library must parse every recorded scenario without an exception and without logging a warning about unknown data. |
| `tests/unit/Filter`, `Supplement` | The search filters offer exactly the fields of the search documentation (`tests/Fixtures/search-fields.json`), and the include flags of the fields classes are exactly those the web service accepts (`tests/Fixtures/accepted-includes.json`). |
| `tests/unit/Http`, `Helper`, `Value`, `Relation` | Classic unit tests (throttling, retries, error handling, type conversion, the map of relationship types). |
| `tests/specification` | Compares the library with the live documentation of relationship types (needs network, runs weekly in CI). |

### Recording new fixtures

Scenarios are defined in `tests/Fixtures/scenarios.php`: each one is a call of the library. `bin/record-fixtures`
performs them against the live web service and stores the responses.

```bash
bin/record-fixtures --list                 # all scenarios
bin/record-fixtures lookup/artist/bowie    # only scenarios whose name contains the pattern
bin/record-fixtures --refresh <pattern>    # ask the web service again
bin/record-fixtures --prune                # (complete run) delete fixtures no scenario uses any more
bin/slim-fixtures                          # apply the shortening rules to recorded fixtures again, offline
bin/probe-includes [pattern]               # ask the web service which inc parameters it accepts (tests/Fixtures/accepted-includes.json)
```

Please keep the following in mind:

- **Be polite.** One request per second at most (the script throttles), and a meaningful user agent. Do not put personal
  data such as your e-mail address into the user agent.
- Prefer popular, well maintained entities. Add sparsely maintained ones as edge cases.
- Long lists are shortened by the store (`FixtureStore::slim()`), so that fixtures stay small.
- Scenarios named `auth/...` need an OAuth2 access token in the environment variable `MB_ACCESS_TOKEN` and are skipped
  without it. Set `MB_EDITOR` to the account name: it is replaced by `example-user` in everything that is stored.
  Never commit tokens, and check the recordings for personal data before you commit them.
- When the recording prints a warning, the library does not know a value yet: add the enum case or the field.

### Adding a field or an entity

1. Implement it in `src/`.
2. Add (or extend) a scenario that returns real data for it, and record it.
3. Add the keys of the new data to the table in `tests/Support/EntityAssertions.php`, so that the tests compare it with the JSON.
4. Run `composer ci`.

## Code style

PER-CS 2 with strict types, enforced by PHP-CS-Fixer. Doc comments of the entities are copied from the official
MusicBrainz documentation; please keep them.
