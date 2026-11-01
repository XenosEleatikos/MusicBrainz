<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Support;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use RuntimeException;

/**
 * A PSR-18 client for offline tests. Answers queued responses and records all requests.
 */
final class FakeHttpClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @var list<ResponseInterface> */
    private array $responses = [];

    public function queue(ResponseInterface $response): self
    {
        $this->responses[] = $response;

        return $this;
    }

    public function queueJson(string $json, int $status = 200): self
    {
        return $this->queue(new Response($status, ['Content-Type' => 'application/json'], $json));
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;

        return array_shift($this->responses)
            ?? throw new RuntimeException('FakeHttpClient: no response queued for ' . $request->getUri());
    }
}
