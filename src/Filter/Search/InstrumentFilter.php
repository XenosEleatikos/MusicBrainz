<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching instruments
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Instrument
 */
final class InstrumentFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\AliasNameTrait;
    use \MusicBrainz\Filter\Property\DisambiguationTrait;
    use \MusicBrainz\Filter\Property\InstrumentDescriptionTrait;
    use \MusicBrainz\Filter\Property\InstrumentIdTrait;
    use \MusicBrainz\Filter\Property\InstrumentNameWithAccentsTrait;
    use \MusicBrainz\Filter\Property\InstrumentNameTrait;
    use \MusicBrainz\Filter\Property\InstrumentTypeTrait;
    use \MusicBrainz\Filter\Property\TagNameTrait;
}
