<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Contract;

use MusicBrainz\Config;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Test\Support\FixtureStore;
use MusicBrainz\Test\Support\ReplayHttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;

use function array_keys;
use function array_map;
use function array_unique;
use function array_values;

/**
 * Contract test: replays every scenario of bin/record-fixtures offline against the recorded real responses. The library
 * must parse them without exception and without logging anything about data it does not know.
 */
final class ScenarioTest extends TestCase
{
    /**
     * Messages known to be caused by gaps of the library. Each entry is a gap to close; remove it when fixed.
     *
     * @var list<string>
     */
    private const KNOWN_GAPS = [
    ];

    /**
     * @return array<string, array{string}>
     */
    public static function scenarios(): array
    {
        $scenarios = require __DIR__ . '/../../Fixtures/scenarios.php';

        return array_map(static fn(string $name): array => [$name], array_combine(array_keys($scenarios), array_keys($scenarios)));
    }

    #[DataProvider('scenarios')]
    public function testScenarioParsesRecordedResponse(string $name): void
    {
        $scenarios = require __DIR__ . '/../../Fixtures/scenarios.php';
        $logger = new class extends AbstractLogger {
            /** @var list<string> */
            public array $messages = [];

            public function log($level, string|Stringable $message, array $context = []): void
            {
                $this->messages[] = "[$level] $message";
            }
        };
        $http = new ReplayHttpClient(new FixtureStore(__DIR__ . '/../../Fixtures/recorded'));
        $musicBrainz = new MusicBrainz(
            $http,
            new Psr17Factory(),
            $logger,
            (new Config())->setMinRequestInterval(0.0)->setAccessToken('test-token'),
        );

        $result = $scenarios[$name]($musicBrainz);

        self::assertNotNull($result);
        self::assertNotEmpty($http->requests);

        $unexpected = array_values(array_filter(
            array_unique($logger->messages),
            static function (string $message): bool {
                foreach (self::KNOWN_GAPS as $gap) {
                    if (str_contains($message, $gap)) {
                        return false;
                    }
                }

                return true;
            },
        ));
        self::assertSame([], $unexpected, 'The library logged problems while parsing ' . $name);
    }
}
