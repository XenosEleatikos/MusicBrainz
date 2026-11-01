<?php

declare(strict_types=1);

namespace MusicBrainz\SpecificationTest;

use DirectoryIterator;
use MusicBrainz\Definition\RelationTypeId;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use SplFileInfo;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

use function array_keys;
use function array_map;
use function explode;
use function implode;
use function preg_match;
use function trim;
use function usleep;
use function sort;
use function str_starts_with;
use function strpos;
use function substr;
use function ucfirst;

class RelationTest extends TestCase
{
    private HttpClientInterface $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = HttpClient::create(['headers' => ['User-Agent' => 'XenosMusicBrainz/2-dev ( https://github.com/XenosEleatikos/MusicBrainz )']]);
    }

    /**
     * This test reads the documentation for {@see https://musicbrainz.org/relationships relationships} and
     * counts the linked pages for more specific relationship types (area-area, area-event...).
     *
     * For the 13 entity types that can be related (the 12 main entities and genres), there should be 91 (13+12+11...)
     * possible pairs, each with an overview page of its relationship types.
     *
     * @return string[] Links to overview pages for each relationship type (area-area, area-event...)
     *
     */
    public function testCountPossibleRelationshipTypes(): array
    {
        $response = $this->get('https://musicbrainz.org/relationships');
        $crawler = new Crawler($response->getContent());
        $links = $crawler->filterXPath('//a');

        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if (str_starts_with($href, '/relationships/')) {
                $hrefs[] = $href;
            }
        }

        self::assertCount(91, $hrefs ?? []);

        return $hrefs;
    }

    /**
     * In general there are relationships between the main entities of MusicBrainz, but for some pairs of
     * entities, there are no relationships defined (yet).
     * When this test fails, there might be new relationships that have to be implemented in the client.
     *
     * @param string[] $hrefs Links to overview pages for each relationship type (area-area, area-event...)
     *
     * @return array<string, Crawler> Links to overview pages for each relationship type (area-area, area-event...)
     *                                and associated crawler
     *
     */
    #[Depends('testCountPossibleRelationshipTypes')]
    public function testCountActualRelationshipTypes(array $hrefs): array
    {
        foreach ($hrefs as $href) {
            $response = $this->get('https://musicbrainz.org/' . $href);
            $crawler = new Crawler($response->getContent());
            /**
             * For some combination of entities, there are no relations defined. We can ignore these pages.
             *
             * @example https://musicbrainz.org/relationships/area-artist
             */
            if (strpos($crawler->text(), 'relationship types found.') === false) {
                $relationTypes[$href] = $crawler;
            }
        }

        self::assertCount(71, $relationTypes);

        return $relationTypes;
    }

    /**
     * Tests that for each relationship type (area-area, area-event...) there is a corresponding folder
     * in `src/Relation/Type`.
     *
     * @param array<string, Crawler> $relationTypes Links to overview pages for each relationship type
     *                                              (area-area, area-event...) and associated crawler
     *
     * @return array<string, Crawler> Links to overview pages for each relationship type (area-area, area-event...)
     *                                 and associated crawler
     */
    #[Depends('testCountActualRelationshipTypes')]
    public function testCountRelationTypeDirectories(array $relationTypes): array
    {
        $directories = self::getDirectories(__DIR__ . '/../../src/Relation/Type/');

        $expectedDirectories = array_map(
            function (string $path): string {
                [$baseType, $targetType] = explode('-', substr($path, 15));

                return self::upperCase($baseType) . '/' . self::upperCase($targetType);
            },
            array_keys($relationTypes)
        );

        sort($expectedDirectories);
        sort($directories);

        self::assertSame(
            $expectedDirectories,
            $directories
        );

        return $relationTypes;
    }

    /**
     * Tests that every relationship type listed at musicbrainz.org is implemented, i.e. known by its UUID.
     *
     * @param array<string, Crawler> $relationTypes
     */
    #[Depends('testCountRelationTypeDirectories')]
    public function testEveryRelationshipTypeIsImplemented(array $relationTypes): void
    {
        $known = RelationTypeId::getClassMap();
        $missing = [];
        foreach ($relationTypes as $page => $crawler) {
            foreach ($crawler->filterXPath('//a') as $link) {
                if (1 === preg_match('~^/relationship/([0-9a-f-]{36})$~', $link->getAttribute('href'), $matches)
                    && !isset($known[$matches[1]])) {
                    $missing[$matches[1]] = $page . ': ' . trim($link->textContent);
                }
            }
        }

        self::assertSame([], $missing, 'Relationship types not implemented (uuid => page: name)');
    }

    /**
     * Requests a page; at most one request per second.
     */
    private function get(string $url): ResponseInterface
    {
        usleep(1_000_000);

        return $this->client->request('GET', $url);
    }

    private static function upperCase(string $string): string
    {
        return implode(
            array_map(
                fn(string $string): string => ucfirst($string),
                explode('_', $string)
            )
        );
    }

    private static function getDirectories(string $path, int $minDepth = 2, int $maxDepth = 2): array
    {
        $maxDepth--;
        $minDepth--;

        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            /** @var SplFileInfo $fileinfo */
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                if ($minDepth <= 0) {
                    $directories[] = $fileinfo->getFilename();
                }
                if ($maxDepth > 0) {
                    foreach (self::getDirectories($fileinfo->getRealPath(), $minDepth, $maxDepth) as $subDir) {
                        $directories[] = $fileinfo->getFilename() . '/' . $subDir;
                    }
                }
            }
        }

        return $directories ?? [];
    }
}
