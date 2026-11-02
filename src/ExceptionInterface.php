<?php

declare(strict_types=1);

namespace MusicBrainz;

use Throwable;

/**
 * Implemented by every exception the library throws on purpose: {@see Exception} and its subclasses for what goes wrong
 * with a request (catch these to handle it), and {@see InvalidArgumentException} for invalid input, which is a
 * programming error.
 */
interface ExceptionInterface extends Throwable {}
