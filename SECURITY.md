# Security policy

## Supported versions

Only the latest major version (2.x) receives security fixes.

## Reporting a vulnerability

Please do not open a public issue. Use GitHub's private vulnerability reporting instead
("Security" tab of the repository, "Report a vulnerability"). You will get an answer as soon as possible.

## What to keep in mind when using the library

- The library never stores credentials. An OAuth2 access token set with `Config::setAccessToken()` is only sent in the
  `Authorization` header of requests that need it (`user-*` includes, private collections), never in the URL.
- Responses of the MusicBrainz web service are user generated content. Escape them before you put them into HTML.
