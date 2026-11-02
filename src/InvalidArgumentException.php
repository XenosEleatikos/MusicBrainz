<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * A value passed to the library is not valid, e.g. an MBID that is not a UUID.
 */
class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface {}
