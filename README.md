# PHP AI SDK — DeepInfra

Text generation, streaming, embeddings, and image generation through DeepInfra. Part of the framework-agnostic [PHP AI SDK](https://phpaisdk.com).

## Installation

```bash
composer require aisdk/deepinfra
```

Set `DEEPINFRA_API_KEY` in your environment.

## Usage

```php
use AiSdk\DeepInfra;
use AiSdk\Generate;

$result = Generate::text('Explain closures in PHP in one sentence.')
    ->model(DeepInfra::model('deepseek-ai/DeepSeek-V4.1-Flash'))
    ->run();

echo $result->text;
```

## Documentation

[Read the documentation](https://phpaisdk.com/docs/0.x/providers/deepinfra) for configuration, supported features, and more examples.

[Contributing](https://github.com/phpaisdk/.github/blob/main/CONTRIBUTING.md) · [Support](https://github.com/phpaisdk/.github/blob/main/SUPPORT.md)

## License

The MIT License (MIT). See [LICENSE](LICENSE) for details.
