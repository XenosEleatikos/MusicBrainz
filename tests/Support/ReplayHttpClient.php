<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A PSR-18 client for offline tests that answers requests with recorded fixtures.
 */
final class ReplayHttpClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    public function __construct(private readonly FixtureStore $store) {}

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;
        $name = $this->store->nameFor($request);

        return new Response(
            $this->store->statusOf($name),
            ['Content-Type' => 'application/json'],
            $this->store->load($name),
        );
    }
}
