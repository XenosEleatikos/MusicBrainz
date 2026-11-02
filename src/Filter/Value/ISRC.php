<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function preg_match;

/**
 * The International Standard Recording Code (ISRC)
 * The International Standard Recording Code, abbreviated to ISRC, is an identification system for audio and music video
 * recordings. It is standardized by the IFPI in ISO 3901:2001 and used by IFPI members to assign a unique identifier to
 * every distinct sound recording they release. An ISRC identifies a particular sound recording, not the song itself.
 * Therefore, different recordings, edits, remixes and remasters of the same song will each be assigned their own ISRC.
 * However, note that same Recording should carry the same ISRC in all countries/territories. Songs are identified by
 * analogous International Standard Musical Work Code (ISWC) codes.
 * Note that an ISRC now is used instead of an ISAN (International Standard AudioVisual Number) for music and audio
 * recordings, as well as for music videos, as the ISRC is more specific, and can have IPIs attached to it, whereas the
 * ISAN was not designed for use in combination with IPIs.
 *
 * @link https://musicbrainz.org/doc/ISRC
 */
final readonly class ISRC implements Stringable
{
    /**
     * @param string $value The value
     *
     * @throws InvalidArgumentException if the value is empty
     */
    public function __construct(public string $value)
    {
        if (1 === preg_match('/^\s*$/u', $value)) {
            throw new InvalidArgumentException('ISRC must not be empty');
        }
        if (1 === preg_match('/\s/u', $value)) {
            throw new InvalidArgumentException('ISRC must not contain whitespace');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
