<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * A request could not be performed or answered: the base class of {@see ApiException}, {@see TransportException},
 * {@see ResponseException} and {@see ConfigurationException}.
 */
class Exception extends \Exception implements ExceptionInterface {}
