<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Attribute;

use App\Cache\Enum\CacheEngine;
use App\Cache\Enum\CacheStrategy;
use Attribute;

#[Attribute(flags: Attribute::TARGET_METHOD)]
class Cacheable
{
    public function __construct(
        private readonly CacheEngine $cacheEngine,
        private readonly CacheStrategy $strategy,
        private readonly string $namespace = '',
        private readonly int $lifeTime = 30,
    ) {}

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return int
     */
    public function getLifeTime(): int
    {
        return $this->lifeTime;
    }

    /**
     * @return CacheEngine
     */
    public function getCacheEngine(): CacheEngine
    {
        return $this->cacheEngine;
    }

    /**
     * @return CacheStrategy
     */
    public function getStrategy(): CacheStrategy
    {
        return $this->strategy;
    }
}