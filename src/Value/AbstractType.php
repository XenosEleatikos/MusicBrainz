<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * Provides base functionality for types.
 */
abstract class AbstractType implements Value
{
    /**
     * Code for an undefined type
     *
     * @var string
     */
    public const UNDEFINED = '';

    /**
     * The type code
     *
     * @var string
     */
    protected $typeCode;

    /**
     * The MusicBrainz Identifier (MBID) of the alias type
     *
     * @var MBID
     */
    private $mbid;

    /**
     * Constructs an alias type.
     *
     * @param string $typeCode An alias type code
     */
    public function __construct(?string $typeCode = self::UNDEFINED, MBID $mbid = null)
    {
        $this->typeCode = $typeCode ?: self::UNDEFINED;
        $this->mbid     = $mbid ?: new MBID();
    }

    /**
     * Returns the MusicBrainz Identifier (MBID) of the instument type.
     *
     * @return MBID
     */
    public function getMbid(): MBID
    {
        return $this->mbid;
    }

    /**
     * Returns the alias type code.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->typeCode;
    }
}
