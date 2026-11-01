<?php

declare(strict_types=1);

namespace MusicBrainz;

use Throwable;

/**
 * Implemented by every exception the library throws on purpose. Catch it to handle anything that goes wrong with a
 * request; {@see InvalidArgumentException} is a programming error and is therefore no {@see Exception}.
 */
interface ExceptionInterface extends Throwable {}
