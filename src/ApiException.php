<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * The web service answered with an HTTP error. The code of the exception is the HTTP status (404 for an unknown MBID, 401
 * if a token is missing or invalid, 503 if the server stays busy after the retries).
 */
class ApiException extends Exception {}
