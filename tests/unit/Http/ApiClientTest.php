<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Http;

use MusicBrainz\Config;
use MusicBrainz\Exception;
use MusicBrainz\Http\ApiClient;
use MusicBrainz\Test\Support\FakeHttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

use function microtime;
use function parse_str;

final class ApiClientTest extends TestCase
{
    private FakeHttpClient $http;

    private ApiClient $client;

    private Config $config;

    protected function setUp(): void
    {
        $this->http = new FakeHttpClient();
        $this->client = new ApiClient($this->http, new Psr17Factory());
        $this->config = (new Config())->setMinRequestInterval(0.0)->setUserAgent('Test/1 ( https://example.org )');
    }

    public function testSendsUserAgentAcceptHeaderAndJsonFormat(): void
    {
        $this->http->queueJson('{"id":"x"}');

        $result = $this->client->call('artist/abc', $this->config, ['inc' => 'aliases+tags']);

        self::assertSame(['id' => 'x'], $result);
        $request = $this->http->requests[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('/ws/2/artist/abc', $request->getUri()->getPath());
        parse_str($request->getUri()->getQuery(), $query);
        self::assertSame(['inc' => 'aliases+tags', 'fmt' => 'json'], $query);
        self::assertSame('Test/1 ( https://example.org )', $request->getHeaderLine('User-Agent'));
        self::assertSame('application/json', $request->getHeaderLine('Accept'));
        self::assertFalse($request->hasHeader('Authorization'));
    }

    public function testRefusesToRequestWithoutUserAgent(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('User Agent');

        $this->client->call('artist/abc', $this->config->setUserAgent(' '));
    }

    public function testSendsBearerTokenIfAuthenticationIsRequired(): void
    {
        $this->http->queueJson('{}');

        $this->client->call('collection', $this->config->setAccessToken('secret'), [], true);

        self::assertSame('Bearer secret', $this->http->requests[0]->getHeaderLine('Authorization'));
    }

    public function testSendsAConfiguredTokenEvenIfNotRequired(): void
    {
        $this->http->queueJson('{}');

        $this->client->call('collection/abc', $this->config->setAccessToken('secret'));

        self::assertSame('Bearer secret', $this->http->requests[0]->getHeaderLine('Authorization'));
    }

    public function testRequiresTokenIfAuthenticationIsRequired(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('access token');

        $this->client->call('collection', $this->config, [], true);
    }

    public function testRetriesWhenTheServerIsBusy(): void
    {
        $this->http->queue(new Response(503, ['Retry-After' => '0'], '{"error":"busy"}'));
        $this->http->queueJson('{"ok":true}');

        $result = $this->client->call('artist/abc', $this->config);

        self::assertSame(['ok' => true], $result);
        self::assertCount(2, $this->http->requests);
    }

    public function testGivesUpAfterTheConfiguredNumberOfRetries(): void
    {
        $this->config->setMaxRetries(1);
        $this->http->queue(new Response(503, ['Retry-After' => '0'], '{"error":"The MusicBrainz web server is currently busy."}'));
        $this->http->queue(new Response(503, ['Retry-After' => '0'], '{"error":"The MusicBrainz web server is currently busy."}'));

        try {
            $this->client->call('artist/abc', $this->config);
            self::fail('An exception was expected');
        } catch (Exception $exception) {
            self::assertSame(503, $exception->getCode());
            self::assertStringContainsString('currently busy', $exception->getMessage());
        }
        self::assertCount(2, $this->http->requests);
    }

    public function testDoesNotWaitForLongerThanItIsReasonable(): void
    {
        $this->http->queue(new Response(503, ['Retry-After' => '3600'], '{"error":"busy"}'));

        $start = microtime(true);
        try {
            $this->client->call('artist/abc', $this->config);
            self::fail('An exception was expected');
        } catch (Exception $exception) {
            self::assertSame(503, $exception->getCode());
        }

        self::assertLessThan(5.0, microtime(true) - $start);
        self::assertCount(1, $this->http->requests);
    }

    public function testReportsErrorMessageAndStatusOfTheApi(): void
    {
        $this->http->queue(new Response(404, [], '{"error":"Not Found"}'));

        try {
            $this->client->call('artist/abc', $this->config);
            self::fail('An exception was expected');
        } catch (Exception $exception) {
            self::assertSame(404, $exception->getCode());
            self::assertSame('MusicBrainz API error: Not Found', $exception->getMessage());
        }
    }

    public function testReportsStatusIfThereIsNoErrorMessage(): void
    {
        $this->http->queue(new Response(502, [], '<html>Bad gateway</html>'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('HTTP 502');

        $this->client->call('artist/abc', $this->config->setMaxRetries(0));
    }

    public function testRejectsResponsesThatAreNotJson(): void
    {
        $this->http->queue(new Response(200, [], 'not json'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unexpected response');

        $this->client->call('artist/abc', $this->config);
    }

    public function testWrapsErrorsOfTheHttpClient(): void
    {
        $failing = new class implements ClientInterface {
            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                throw new class ('connection refused') extends RuntimeException implements ClientExceptionInterface {};
            }
        };

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('connection refused');

        (new ApiClient($failing, new Psr17Factory()))->call('artist/abc', $this->config);
    }

    public function testKeepsTheMinimumIntervalBetweenRequests(): void
    {
        $this->config->setMinRequestInterval(0.3);
        $this->http->queueJson('{}')->queueJson('{}');

        $this->client->call('artist/a', $this->config);
        $start = microtime(true);
        $this->client->call('artist/b', $this->config);

        self::assertGreaterThanOrEqual(0.25, microtime(true) - $start);
    }
}
