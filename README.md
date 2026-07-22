# aisdk/deepinfra

<a href="https://github.com/phpaisdk/deepinfra/actions"><img alt="GitHub Workflow Status" src="https://img.shields.io/github/actions/workflow/status/phpaisdk/deepinfra/tests.yml?branch=main&label=Tests"></a>
<a href="https://packagist.org/packages/aisdk/deepinfra"><img alt="Latest Version" src="https://img.shields.io/packagist/v/aisdk/deepinfra"></a>
<a href="https://packagist.org/packages/aisdk/deepinfra"><img alt="License" src="https://img.shields.io/packagist/l/aisdk/deepinfra"></a>

------

Official DeepInfra provider for the PHP AI SDK. Uses DeepInfra's OpenAI-compatible API.

## Installation

```bash
composer require aisdk/deepinfra
```

## Basic Usage

```php
use AiSdk\DeepInfra;
use AiSdk\Generate;

DeepInfra::create(['apiKey' => $_ENV['DEEPINFRA_API_KEY']]);

$result = Generate::text('Explain this code briefly.')
    ->model(DeepInfra::model('gpt-oss-120b'))
    ->run();
```

## Configuration

| Variable | Description | Default |
| --- | --- | --- |
| `DEEPINFRA_API_KEY` | API key for authentication | Required |
| `DEEPINFRA_BASE_URL` | Base URL for API requests | `https://api.deepinfra.com/v1/openai` |

## Supported Capabilities

| Capability | Support |
| --- | --- |
| Text generation and streaming | Native OpenAI-compatible API |
| Embeddings | Native |
| Image generation | Native |
| Tools, structured output, reasoning, multimodal input | Passed through for supported models |

Use `providerOptions('deepinfra', ['raw' => [...]])` for documented DeepInfra fields outside the portable SDK surface. Model IDs are opaque strings and are validated by DeepInfra.

## Documentation

- [DeepInfra API reference](https://docs.deepinfra.com/api-reference/introduction)
- [PHP AI SDK documentation](https://phpaisdk.com/docs/deepinfra)
