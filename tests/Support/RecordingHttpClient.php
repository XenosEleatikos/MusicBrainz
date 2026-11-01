<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A PSR-18 decorator that records responses of a real HTTP client in a {@see FixtureStore}.
 *
 * Fixtures that already exist are answered from the store without a network request, unless $refresh is set. That
 * way a recording run never asks the web service twice for the same request.
 */
final class RecordingHttpClient implements ClientInterface
{
    public int $networkRequests = 0;

    public function __construct(
        private readonly ClientInterface $inner,
        private readonly FixtureStore $store,
        private readonly bool $refresh = false,
    ) {}

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $name = $this->store->nameFor($request);

        if (!$this->refresh && $this->store->has($name)) {
            return (new ReplayHttpClient($this->store))->sendRequest($request);
        }

        ++$this->networkRequests;
        $response = $this->inner->sendRequest($request);
        $body = (string) $response->getBody();
        $this->store->save($name, $request, $response->getStatusCode(), $body);

        return $response->withBody((new \Nyholm\Psr7\Factory\Psr17Factory())->createStream($body));
    }
}
