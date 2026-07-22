# DeepInfra provider for PHP AI SDK

```bash
composer require aisdk/deepinfra
```

```php
use AiSdk\Generate;
use AiSdk\DeepInfra;

DeepInfra::create(['apiKey' => $_ENV['DEEPINFRA_API_KEY']]);

$result = Generate::text('Explain this code briefly.')
    ->model(DeepInfra::model('gpt-oss-120b'))
    ->run();
```

This package uses DeepInfra's official OpenAI-compatible API at `https://api.deepinfra.com/v1/openai`. It supports chat and streaming generation, embeddings, and image generation. Tool calling, structured output, reasoning, and multimodal input are passed through when the selected DeepInfra model supports them. See [DeepInfra API documentation](https://docs.deepinfra.com/api-reference/introduction) and [PHP AI SDK documentation](https://phpaisdk.com/docs/deepinfra).
