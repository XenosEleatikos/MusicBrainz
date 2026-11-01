<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * One of the entities of MusicBrainz that a request returns or a relationship points to.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_Entity
 */
interface Entity extends Parsable {}
