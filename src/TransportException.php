<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * The HTTP client failed before an answer arrived (no connection, timeout, ...). The previous exception is the one of
 * the PSR-18 client.
 */
class TransportException extends Exception {}
