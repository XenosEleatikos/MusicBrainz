<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\InvalidArgumentException;
use Stringable;

use function abs;
use function filter_var;
use function preg_match;
use function str_pad;
use function substr;

use const FILTER_SANITIZE_NUMBER_INT;
use const STR_PAD_LEFT;

/**
 * LabelCode
 */
final readonly class LabelCode implements Stringable
{
    /** The code in the format "LC-01234" (empty if there is none) */
    public string $value;

    /**
     * The code
     * - must be a number between 1 and 99999
     * - may be prefixed by "LC" (case insensitive), where the prefix may be separated with a dash ("-") or a space (" ")
     *
     * @param string $value A label code
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if (1 !== preg_match('/^(LC)?[-| ]?(?=.*[1-9].*)[0-9]{1,5}$/i', $value)) {
            throw new InvalidArgumentException('"' . $value . '" is not a valid label code (a number from 1 to 99999, optionally prefixed with LC)');
        }
        $this->value = 'LC-' . str_pad((string) abs((int) filter_var($value, FILTER_SANITIZE_NUMBER_INT)), 5, '0', STR_PAD_LEFT);
    }

    /**
     * Returns the label code without the "LC-" prefix.
     */
    public function withoutPrefix(): string
    {
        return substr($this->value, 3);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
