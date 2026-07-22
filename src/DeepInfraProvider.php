<?php

declare(strict_types=1);

namespace AiSdk\DeepInfra;

use AiSdk\Contracts\BaseProvider;
use AiSdk\Contracts\EmbeddingModelInterface;
use AiSdk\Contracts\EmbeddingProviderInterface;
use AiSdk\Contracts\ImageModelInterface;
use AiSdk\Contracts\ImageProviderInterface;
use AiSdk\Contracts\TextModelInterface;
use AiSdk\Contracts\TextProviderInterface;
use AiSdk\DeepInfra\Models\DeepInfraEmbeddingModel;
use AiSdk\DeepInfra\Models\DeepInfraImageModel;
use AiSdk\DeepInfra\Models\DeepInfraTextModel;

final class DeepInfraProvider extends BaseProvider implements EmbeddingProviderInterface, ImageProviderInterface, TextProviderInterface
{
    public function __construct(public readonly DeepInfraOptions $options) {}
    public function name(): string
    {
        return DeepInfraOptions::PROVIDER_NAME;
    }
    protected function textModel(string $modelId): TextModelInterface
    {
        return new DeepInfraTextModel($modelId, $this->options);
    }
    protected function imageModel(string $modelId): ImageModelInterface
    {
        return new DeepInfraImageModel($modelId, $this->options);
    }
    protected function embeddingModel(string $modelId): EmbeddingModelInterface
    {
        return new DeepInfraEmbeddingModel($modelId, $this->options);
    }
}
