<?php

declare(strict_types=1);
use AiSdk\DeepInfra;
use AiSdk\DeepInfra\Tests\Fakes\FakeHttpClient;
use AiSdk\Generate;
use AiSdk\Support\Sdk;
use Nyholm\Psr7\Factory\Psr17Factory;

afterEach(function (): void {
    Generate::reset();
    DeepInfra::reset();
});
it('uses DeepInfra general OpenAI-compatible chat completions', function (): void {
    $client = new FakeHttpClient(200, json_encode(['id' => 'deepinfra-chat', 'model' => 'gpt-oss-120b', 'choices' => [['message' => ['content' => 'Hello from DeepInfra Inference'], 'finish_reason' => 'stop']], 'usage' => ['prompt_tokens' => 3, 'completion_tokens' => 4]]));
    $factory = new Psr17Factory();
    Generate::configure(new Sdk($client, $factory, $factory));
    DeepInfra::create(['apiKey' => 'deepinfra-test']);
    $result = Generate::text('Hi')->model(DeepInfra::model('gpt-oss-120b'))->run();
    expect($result->text)->toBe('Hello from DeepInfra Inference')->and((string) $client->lastRequest?->getUri())->toBe('https://api.deepinfra.com/v1/openai/chat/completions')->and($client->lastRequest?->getHeaderLine('Authorization'))->toBe('Bearer deepinfra-test')->and($client->sentBody()['model'])->toBe('gpt-oss-120b');
});
it('accepts opaque DeepInfra model identifiers', function (): void {
    DeepInfra::create(['apiKey' => 'deepinfra-test']);
    expect(DeepInfra::model('private-gpt-oss-120b-model')->modelId())->toBe('private-gpt-oss-120b-model');
});

it('generates OpenAI-compatible DeepInfra images', function (): void {
    $client = new FakeHttpClient(200, json_encode(['data' => [['b64_json' => base64_encode('image-bytes')]] ]));
    $factory = new Psr17Factory();
    Generate::configure(new Sdk($client, $factory, $factory));
    DeepInfra::create(['apiKey' => 'deepinfra-test']);

    $result = Generate::image('A studio photograph of a red kite')
        ->model(DeepInfra::model('black-forest-labs/FLUX-1-schnell'))
        ->run();

    expect($result->output->base64)->toBe(base64_encode('image-bytes'))
        ->and((string) $client->lastRequest?->getUri())->toBe('https://api.deepinfra.com/v1/openai/images/generations')
        ->and($client->sentBody()['response_format'])->toBe('b64_json');
});

it('generates OpenAI-compatible DeepInfra embeddings', function (): void {
    $client = new FakeHttpClient(200, json_encode(['data' => [['index' => 0, 'embedding' => [0.1, 0.2]]], 'usage' => ['prompt_tokens' => 2, 'total_tokens' => 2]]));
    $factory = new Psr17Factory();
    Generate::configure(new Sdk($client, $factory, $factory));
    DeepInfra::create(['apiKey' => 'deepinfra-test']);

    $result = Generate::embedding('A document')
        ->model(DeepInfra::model('Qwen/Qwen3-Embedding-8B'))
        ->run();

    expect($result->output->vector)->toBe([0.1, 0.2])
        ->and((string) $client->lastRequest?->getUri())->toBe('https://api.deepinfra.com/v1/openai/embeddings');
});
