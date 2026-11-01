<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Api;

use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Test\Support\FakeHttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;

use function file_get_contents;
use function parse_str;

/**
 * Base class for API tests: serves recorded fixtures through a fake PSR-18 client, so tests run offline.
 */
abstract class ApiTestCase extends TestCase
{
    protected FakeHttpClient $httpClient;

    protected MusicBrainz $musicBrainz;

    protected function setUp(): void
    {
        $this->httpClient  = new FakeHttpClient();
        $this->musicBrainz = new MusicBrainz(
            $this->httpClient,
            new Psr17Factory(),
            config: (new Config())->setMinRequestInterval(0.0)->setAccessToken('test-token'),
        );
    }

    /**
     * Queues a fixture as response and asserts the request when the test is done.
     *
     * @param string               $path       Expected path (relative to the API URL)
     * @param array<string,string> $parameters Expected query parameters (fmt=json is added implicitly)
     * @param string               $fixture    A fixture file relative to tests/unit/Fixtures
     */
    protected function expectApiCall(string $path, array $parameters, string $fixture): void
    {
        $this->httpClient->queueJson((string) file_get_contents(__DIR__ . '/../Fixtures/' . $fixture));
        $this->expected = [$path, $parameters];
    }

    /** @var array{0:string,1:array<string,string>}|null */
    private ?array $expected = null;

    protected function assertPostConditions(): void
    {
        if (null === $this->expected) {
            return;
        }
        [$path, $parameters] = $this->expected;
        self::assertCount(1, $this->httpClient->requests);
        $uri = $this->httpClient->requests[0]->getUri();
        self::assertSame('/ws/2/' . $path, $uri->getPath());
        parse_str($uri->getQuery(), $actual);
        $parameters = array_map(strval(...), $parameters + ['fmt' => 'json']);
        ksort($parameters);
        ksort($actual);
        self::assertSame($parameters, $actual);
    }
}
