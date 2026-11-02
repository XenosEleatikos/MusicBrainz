<?php

declare(strict_types=1);

namespace MusicBrainz\Test;

use MusicBrainz\Config;
use MusicBrainz\InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function testDefaults(): void
    {
        $config = new Config();

        self::assertSame('https://musicbrainz.org/ws/2', $config->getApiUrl());
        self::assertSame(Config::DEFAULT_USER_AGENT, $config->getUserAgent());
        self::assertSame(1.0, $config->getMinRequestInterval());
        self::assertSame(2, $config->getMaxRetries());
        self::assertNull($config->getAccessToken());
    }

    public function testTheApiUrlLosesItsTrailingSlash(): void
    {
        self::assertSame('https://example.org/ws/2', (new Config())->setApiUrl('https://example.org/ws/2/')->getApiUrl());
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidUrls(): array
    {
        return ['no scheme' => ['example.org/ws/2'], 'other scheme' => ['ftp://example.org'], 'empty' => ['']];
    }

    #[DataProvider('invalidUrls')]
    public function testRefusesAnApiUrlThatIsNoHttpUrl(string $url): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new Config())->setApiUrl($url);
    }

    public function testRefusesANegativeInterval(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new Config())->setMinRequestInterval(-0.5);
    }

    public function testRefusesNegativeRetries(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new Config())->setMaxRetries(-1);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidHeaderValues(): array
    {
        return ['empty' => [''], 'blank' => [' '], 'new line' => ["A\r\nX-Injected: 1"], 'tab' => ["A\tB"], 'nul' => ["A\0B"]];
    }

    #[DataProvider('invalidHeaderValues')]
    public function testRefusesAUserAgentThatIsNoHeaderValue(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new Config())->setUserAgent($value);
    }

    #[DataProvider('invalidHeaderValues')]
    public function testRefusesATokenThatIsNoHeaderValue(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new Config())->setAccessToken($value);
    }

    public function testTheTokenCanBeRemoved(): void
    {
        self::assertNull((new Config())->setAccessToken('abc')->setAccessToken(null)->getAccessToken());
    }
}
