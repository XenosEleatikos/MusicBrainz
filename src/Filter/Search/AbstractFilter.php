<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

use AskLucy\Expression\Clause\Clause;
use AskLucy\Expression\Clause\Phrase;
use AskLucy\Exception\InvalidArgumentException as AskLucyException;
use AskLucy\Expression\Clause\Query;
use AskLucy\Expression\Clause\Term;
use MusicBrainz\InvalidArgumentException;

/**
 * An abstract filter
 */
abstract class AbstractFilter
{
    /** @var list<Clause> */
    private array $clauses = [];

    private bool $matchAny = false;

    /**
     * Makes a hit sufficient if it matches any one of the criteria. By default a hit has to match all of them: every
     * criterion narrows the result.
     */
    public function matchAny(): static
    {
        $this->matchAny = true;

        return $this;
    }

    /**
     * Returns the query in Lucene syntax, as it is sent to the web service; empty if there is no criterion yet.
     */
    public function __toString(): string
    {
        $query = new Query();
        foreach ($this->clauses as $index => $clause) {
            if (0 === $index) {
                $query->add($clause);
            } elseif ($this->matchAny) {
                $query->or($clause);
            } else {
                $query->and($clause);
            }
        }

        return (string) $query;
    }

    /**
     * Adds a search word (no whitespace) for a field.
     *
     * @throws InvalidArgumentException if the word is empty or not a single word
     */
    protected function addTerm(string $searchWord, string $field): Term
    {
        try {
            $term = new Term($searchWord, $field);
        } catch (AskLucyException $exception) {
            throw new InvalidArgumentException('Cannot search for "' . $searchWord . '" in "' . $field . '": ' . $exception->getMessage(), 0, $exception);
        }

        $this->clauses[] = $term;

        return $term;
    }

    /**
     * Adds search words (a phrase) for a field.
     *
     * @throws InvalidArgumentException if the phrase is empty or not valid text
     */
    protected function addPhrase(string $searchWords, string $field): Phrase
    {
        try {
            $phrase = new Phrase($searchWords, $field);
        } catch (AskLucyException $exception) {
            throw new InvalidArgumentException('Cannot search for "' . $searchWords . '" in "' . $field . '": ' . $exception->getMessage(), 0, $exception);
        }

        $this->clauses[] = $phrase;

        return $phrase;
    }
}
