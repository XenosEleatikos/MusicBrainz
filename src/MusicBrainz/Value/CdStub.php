<?php

namespace MusicBrainz\Value;

/**
 * A CD stub
 * A CD stub is an anonymously submitted track list that contains a disc ID, barcode, comment field, and basic metadata
 * like a release title and track names.
 * All CD stubs are segregated from the main database and are editable by anyone (whether they are logged in or not),
 * however, they don't benefit from core MusicBrainz features such as edit history, permanent unique identifiers
 * (MBIDs), relationships, release information (date, country, label, etc.), and much more.
 * CD stubs were implemented as a means for people to easily contribute data to MusicBrainz when they are unable, or
 * unwilling, to create an account and add a release. They also enable us to store "untrusted" metadata like the CD Baby
 * music catalog, and to actively serve all this content without cluttering the main database.
 */
class CdStub
{
    use Property\ArtistNameTrait;
    use Property\BarcodeTrait;
    use Property\DisambiguationTrait;
    use Property\TitleTrait;

    /**
     * Constructs an area.
     *
     * @param array $cdStub Information about a CD stub
     */
    public function __construct(array $cdStub = [])
    {
        $this->artistName     = new Name(isset($cdStub['artist']) ? $cdStub['artist'] : '');
        $this->barcode        = new Barcode(isset($cdStub['barcode']) ? $cdStub['barcode'] : '');
        $this->disambiguation = new Disambiguation(isset($cdStub['iso-3166-1-codes']) ? $cdStub['iso-3166-1-codes'] : []);
        $this->title          = new Title(isset($cdStub['iso-3166-2-codes']) ? $cdStub['iso-3166-2-codes'] : []);
    }

    /**
     * Returns the CD stub as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->title . '(' . $this->artistName . ')';
    }
}