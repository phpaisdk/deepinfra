<?php

declare(strict_types=1);

namespace AiSdk\DeepInfra\Tests\Fakes;

use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class FakeHttpClient implements ClientInterface
{
    public ?RequestInterface $lastRequest = null;
    public function __construct(private readonly int $status, private readonly string $body) {} public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->lastRequest = $request;

        return new Response($this->status, ['Content-Type' => 'application/json'], $this->body);
    } /** @return array<string,mixed> */ public function sentBody(): array
    {
        $body = json_decode((string) $this->lastRequest?->getBody(), true);

        return is_array($body) ? $body : [];
    }
}
