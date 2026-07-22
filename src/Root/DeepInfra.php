<?php

declare(strict_types=1);

namespace AiSdk;

use AiSdk\Contracts\Model;
use AiSdk\DeepInfra\DeepInfraOptions;
use AiSdk\DeepInfra\DeepInfraProvider;

final class DeepInfra
{
    private static ?DeepInfraProvider $default = null;
    /** @param array<string, mixed> $config */
    public static function create(array $config = []): DeepInfraProvider
    {
        return self::$default = new DeepInfraProvider(DeepInfraOptions::fromArray($config));
    }
    public static function default(): DeepInfraProvider
    {
        return self::$default ??= self::create();
    }
    public static function reset(): void
    {
        self::$default = null;
    }
    public static function model(string $modelId): Model
    {
        return self::default()->model($modelId);
    }
}
