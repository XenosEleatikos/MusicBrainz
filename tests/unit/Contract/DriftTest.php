<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Contract;

use FilesystemIterator;
use MusicBrainz\Test\Support\FixtureStore;
use MusicBrainz\Value\EntityType;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

use function file_get_contents;
use function is_array;
use function json_decode;
use function sort;
use function str_contains;
use function str_ends_with;
use function dirname;
use function in_array;
use function is_string;
use function strlen;

/**
 * Drift check: every JSON key found in the recorded real responses must occur as string literal in src/. A key that
 * does not is data the library silently ignores.
 */
final class DriftTest extends TestCase
{
    /**
     * Keys known to be ignored. Each entry is a gap to close: implement the key, then remove it here.
     *
     * @var list<string>
     */
    private const KNOWN_GAPS = [
        'annotations',        // search result lists, keyed by the kind of result
        'cdstubs',
        'target',             // relation: MBID of the target, redundant with the target entity (search results)
        'target-type',        // relation: entity type of the target, derived from the relation type and direction
    ];

    public function testLibraryReadsEveryKeyOfTheRecordedResponses(): void
    {
        $source = '';
        foreach (self::files(__DIR__ . '/../../../src') as $file) {
            $source .= file_get_contents($file);
        }

        $keys = [];
        $recorded = (string) realpath(__DIR__ . '/../../Fixtures/recorded');
        $index = (new FixtureStore($recorded))->index();
        foreach (self::files($recorded) as $file) {
            $name = ltrim(substr($file, strlen($recorded)), '/');
            if (!str_ends_with($file, '.json') || str_ends_with($file, 'index.json') || 200 !== ($index[$name]['status'] ?? 200)) {
                continue;
            }
            $data = json_decode((string) file_get_contents($file), true);
            if (is_array($data)) {
                self::collect($data, $keys, $file);
            }
        }

        $missing = [];
        foreach ($keys as $key => $example) {
            // "<entity>-count" and "<entity>-offset" are assembled from the entity type
            if (preg_match('/-(count|offset)$/', $key)) {
                continue;
            }
            // plural entity names are list keys built from the entity type
            if (str_ends_with($key, 's') && null !== EntityType::tryFrom(substr($key, 0, -1))) {
                continue;
            }
            if (!str_contains($source, "'$key'") && !str_contains($source, "\"$key\"") && !in_array($key, self::KNOWN_GAPS, true)) {
                $missing[$key] = $example;
            }
        }
        ksort($missing);

        self::assertSame([], $missing, 'Keys in real responses that src/ never mentions (key => first file)');
    }

    /**
     * @param array<mixed>         $data
     * @param array<string,string> $keys
     */
    private static function collect(array $data, array &$keys, string $file): void
    {
        foreach ($data as $key => $value) {
            // Maps keyed by data, not by the schema: relation attribute names/ids
            if (in_array($key, ['attribute-values', 'attribute-ids', 'attribute-credits'], true)) {
                continue;
            }
            if (is_string($key) && !isset($keys[$key])) {
                $keys[$key] = basename(dirname($file)) . '/' . basename($file);
            }
            if (is_array($value)) {
                self::collect($value, $keys, $file);
            }
        }
    }

    /**
     * @return list<string>
     */
    private static function files(string $directory): array
    {
        $files = [];
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS)) as $file) {
            $files[] = $file->getPathname();
        }
        sort($files);

        return $files;
    }
}
