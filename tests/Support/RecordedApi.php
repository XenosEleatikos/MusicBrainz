<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Log\AbstractLogger;
use Stringable;

use function json_decode;

/**
 * Gives tests a library instance that answers from the recorded real responses (tests/Fixtures/recorded).
 */
final class RecordedApi
{
    public readonly MusicBrainz $musicBrainz;

    public readonly ReplayHttpClient $http;

    /** @var list<string> */
    public array $logged = [];

    private readonly FixtureStore $store;

    public function __construct()
    {
        $this->store = new FixtureStore(__DIR__ . '/../Fixtures/recorded');
        $this->http = new ReplayHttpClient($this->store);
        $logger = new class ($this) extends AbstractLogger {
            public function __construct(private readonly RecordedApi $api) {}

            public function log($level, string|Stringable $message, array $context = []): void
            {
                $this->api->logged[] = "[$level] $message";
            }
        };
        $this->musicBrainz = new MusicBrainz(
            $this->http,
            new Psr17Factory(),
            $logger,
            (new Config())->setMinRequestInterval(0.0)->setAccessToken('test-token'),
        );
    }

    /**
     * Returns the decoded JSON of the response the last request received.
     *
     * @return array<string,mixed>
     */
    public function lastResponse(): array
    {
        $request = $this->http->requests[array_key_last($this->http->requests)];

        return json_decode($this->store->load($this->store->nameFor($request)), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<string, callable(MusicBrainz): mixed>
     */
    public static function scenarios(): array
    {
        return require __DIR__ . '/../Fixtures/scenarios.php';
    }
}
