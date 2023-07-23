<?php /** @noinspection PhpComposerExtensionStubsInspection */

namespace App\Cache\Enum;

use http\Exception\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;

enum CacheEngine: string
{
    case Redis = 'redis';
    case Memcache = 'memcache';
    case File = 'file';

    public function getEngine(): string
    {
        return match($this) {
            CacheEngine::Redis => RedisAdapter::class,
            CacheEngine::Memcache => MemcachedAdapter::class,
            CacheEngine::File => FilesystemAdapter::class,
            default => throw new InvalidArgumentException('Engine does not supported'),
        };
    }
}
