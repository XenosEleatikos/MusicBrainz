<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching events
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Event
 */
class EventFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\AliasNameTrait;
    use \MusicBrainz\Filter\Property\AreaIdTrait;
    use \MusicBrainz\Filter\Property\AreaNameTrait;
    use \MusicBrainz\Filter\Property\ArtistIdTrait;
    use \MusicBrainz\Filter\Property\ArtistNameWithoutAccentsTrait;
    use \MusicBrainz\Filter\Property\BeginDateTrait;
    use \MusicBrainz\Filter\Property\DisambiguationTrait;
    use \MusicBrainz\Filter\Property\EndDateTrait;
    use \MusicBrainz\Filter\Property\EndedTrait;
    use \MusicBrainz\Filter\Property\EventIdTrait;
    use \MusicBrainz\Filter\Property\EventNameWithAccentsTrait;
    use \MusicBrainz\Filter\Property\EventNameWithoutAccentsTrait;
    use \MusicBrainz\Filter\Property\EventTypeTrait;
    use \MusicBrainz\Filter\Property\PlaceIdTrait;
    use \MusicBrainz\Filter\Property\PlaceNameTrait;
    use \MusicBrainz\Filter\Property\TagNameTrait;
}
