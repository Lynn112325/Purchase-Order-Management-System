<?php
class CacheManager
{
    public static function get(string $key) {
        return apcu_fetch($key);
    }

    // set cache key, data and time to live
    public static function set(string $key, $data, int $ttl): bool {
        return apcu_store($key, $data, $ttl);
    }

    public static function delete(string $key): bool {
        return apcu_delete($key);
    }
    
    // check if the cache is exists
    public static function exists(string $key): bool {
        return apcu_exists($key);
    }

    // clear all cache
    public static function clearCache(): bool {
        return apcu_clear_cache();
    }

    // get cache information
    public static function getInfo(): array {
        return apcu_cache_info();
    }
}