<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching works
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Work
 */
class WorkFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\WorkIdTrait;
    use \MusicBrainz\Filter\Property\IswcTrait;
    use \MusicBrainz\Filter\Property\AliasNameTrait;
    use \MusicBrainz\Filter\Property\ArtistIdTrait;
    use \MusicBrainz\Filter\Property\ArtistNameWithoutAccentsTrait;
    use \MusicBrainz\Filter\Property\DisambiguationTrait;
    use \MusicBrainz\Filter\Property\LanguageTrait;
    use \MusicBrainz\Filter\Property\TagNameTrait;
    use \MusicBrainz\Filter\Property\WorkNameWithAccentsTrait;
    use \MusicBrainz\Filter\Property\WorkNameWithoutAccentsTrait;
    use \MusicBrainz\Filter\Property\WorkTypeTrait;
}
