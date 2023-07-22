<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Attribute;

use Attribute;
use DateTimeInterface;

#[Attribute(flags: Attribute::TARGET_CLASS)]
class Cacheable
{
    public function __construct(
        private readonly DateTimeInterface $lifeTime,
        private readonly string $cacheEngine = 'redis',
        private readonly string $strategy = 'readonly',
    ) {}

    /**
     * @return DateTimeInterface
     */
    public function getLifeTime(): DateTimeInterface
    {
        return $this->lifeTime;
    }

    /**
     * @return string
     */
    public function getCacheEngine(): string
    {
        return $this->cacheEngine;
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }
}