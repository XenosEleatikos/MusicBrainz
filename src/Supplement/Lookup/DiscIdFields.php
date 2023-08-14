<?php

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

class DiscIdFields extends Fields
{
    use \MusicBrainz\Supplement\Field\ArtistsTrait;
    use \MusicBrainz\Supplement\Field\LabelsTrait;
    use \MusicBrainz\Supplement\Field\RecordingsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupsTrait;
    use \MusicBrainz\Supplement\Field\MediaTrait;
    use \MusicBrainz\Supplement\Field\ArtistCreditsTrait;
    use \MusicBrainz\Supplement\Field\DiscIdsTrait;
    use \MusicBrainz\Supplement\Field\IsrcsTrait;
    use \MusicBrainz\Supplement\Field\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\RecordingRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupRelationsTrait;
    use \MusicBrainz\Supplement\Field\UrlRelationsTrait;
    use \MusicBrainz\Supplement\Field\WorkRelationsTrait;
    use \MusicBrainz\Supplement\Field\RecordingLevelRelationsTrait;
    use \MusicBrainz\Supplement\Field\WorkLevelRelationsTrait;
}
