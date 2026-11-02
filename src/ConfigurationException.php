<?php

declare(strict_types=1);

namespace MusicBrainz;

/**
 * The configuration does not allow the request, e.g. there is no user agent, or the request needs an access token and
 * none is set.
 */
class ConfigurationException extends Exception {}
