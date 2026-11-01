<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use JsonException;
use Psr\Http\Message\RequestInterface;
use RuntimeException;

use function array_shift;
use function crc32;
use function dirname;
use function explode;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function is_dir;
use function json_decode;
use function json_encode;
use function ksort;
use function mkdir;
use function parse_str;
use function preg_replace;
use function sprintf;
use function str_starts_with;
use function substr;
use function trim;
use function count;
use function is_array;

use const JSON_PRETTY_PRINT;
use const JSON_THROW_ON_ERROR;
use const JSON_UNESCAPED_SLASHES;
use const JSON_UNESCAPED_UNICODE;
use const LOCK_EX;

/**
 * Stores responses of the MusicBrainz web service as files, one file per distinct request, and keeps an index with
 * the request URL, the HTTP status and the time of recording.
 */
final class FixtureStore
{
    private const INDEX = 'index.json';

    public function __construct(private readonly string $directory) {}

    /**
     * Returns the file name (relative to the fixture directory) for a request, e.g.
     * "artist/b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d__inc=aliases+tags-1a2b3c4d.json".
     */
    public function nameFor(RequestInterface $request): string
    {
        $uri = $request->getUri();
        $path = trim($uri->getPath(), '/');
        if (str_starts_with($path, 'ws/2/')) {
            $path = substr($path, 5);
        }
        $segments = explode('/', $path);
        $entity = array_shift($segments);
        $rest = $segments ? implode('_', $segments) : 'list';

        parse_str($uri->getQuery(), $query);
        unset($query['fmt']);
        ksort($query);
        $queryString = http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        $slug = substr((string) preg_replace('/[^A-Za-z0-9=+_.-]+/', '_', urldecode($queryString)), 0, 80);

        return sprintf('%s/%s__%s-%08x.json', $entity, $rest, $slug, crc32($queryString));
    }

    public function has(string $name): bool
    {
        return file_exists($this->directory . '/' . $name);
    }

    public function load(string $name): string
    {
        $content = @file_get_contents($this->directory . '/' . $name);
        if (false === $content) {
            throw new RuntimeException('Fixture not found: ' . $name . ' (record it with bin/record-fixtures)');
        }

        return $content;
    }

    /**
     * Returns the HTTP status recorded for the fixture (200 if the index has no entry).
     */
    public function statusOf(string $name): int
    {
        return (int) ($this->index()[$name]['status'] ?? 200);
    }

    /**
     * Shortens long lists of objects in a decoded response while keeping its variety: of every group of elements
     * with the same structure (and the same "type"/"target-type" for relations) only the first few are kept. Real
     * responses of popular entities can be many megabytes large.
     *
     * @param int $maxPerShape Maximum number of elements kept per structure
     * @param int $threshold   Lists with at most this many elements are left untouched
     */
    public static function slim(mixed $data, int $maxPerShape = 3, int $threshold = 8): mixed
    {
        if (!is_array($data)) {
            return $data;
        }

        if (array_is_list($data) && count($data) > $threshold && is_array($data[0] ?? null)) {
            $kept = [];
            $seen = [];
            foreach ($data as $element) {
                $shape = md5(json_encode(self::shape($element)) . '|' . ($element['type'] ?? '') . '|' . ($element['target-type'] ?? ''));
                $seen[$shape] = ($seen[$shape] ?? 0) + 1;
                if ($seen[$shape] <= $maxPerShape) {
                    $kept[] = $element;
                }
            }
            $data = $kept;
        }

        foreach ($data as $key => $value) {
            $data[$key] = self::slim($value, $maxPerShape, $threshold);
        }

        return $data;
    }

    /**
     * Describes the structure of a list element: its keys (not the nested structure), so that elements are only
     * regarded as different if they have other fields, or another relation type.
     */
    private static function shape(mixed $value): mixed
    {
        if (!is_array($value) || array_is_list($value)) {
            return get_debug_type($value);
        }
        $keys = array_keys($value);
        sort($keys);

        return $keys;
    }

    public function save(string $name, RequestInterface $request, int $status, string $body, bool $slim = true): void
    {
        $file = $this->directory . '/' . $name;
        $wasSlimmed = false;
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0o777, true);
        }

        try {
            $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            $slimmed = $slim ? self::slim($decoded) : $decoded;
            $wasSlimmed = $slimmed !== $decoded;
            $body = json_encode(
                $slimmed,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            // keep non-JSON bodies as they are
            $wasSlimmed = false;
        }
        file_put_contents($file, $body . "\n");

        $index = $this->index();
        $index[$name] = [
            'url' => (string) $request->getUri(),
            'status' => $status,
            'recorded' => gmdate('c'),
        ] + ($wasSlimmed ? ['slimmed' => true] : []);
        ksort($index);
        file_put_contents(
            $this->directory . '/' . self::INDEX,
            json_encode($index, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n",
            LOCK_EX
        );
    }

    /**
     * @return array<string, array{url: string, status: int, recorded: string, slimmed?: bool}>
     */
    public function index(): array
    {
        $file = $this->directory . '/' . self::INDEX;
        if (!file_exists($file)) {
            return [];
        }

        return json_decode((string) file_get_contents($file), true) ?? [];
    }
}
