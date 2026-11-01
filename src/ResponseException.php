<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * The web service answered, but not with the JSON the library expects.
 */
class ResponseException extends Exception {}
