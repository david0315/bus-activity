<?php

use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\JobInterface;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\Utils\ApplicationContext;

/**
 * 获取Container
 */
if (!function_exists('DI')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param null|mixed $id
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function DI($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}

/**
 * redis 客户端实例
 */
if (!function_exists('redis')) {
    function redis()
    {
        return DI()->get(\Redis::class);
    }
}

/**
 * 缓存实例 简单的缓存
 */
if (!function_exists('cache')) {
    function cache()
    {
        return DI()->get(\Psr\SimpleCache\CacheInterface::class);
    }
}

if (!function_exists('format_throwable')) {
    /**
     * Format a throwable to string.
     * @param \Throwable $throwable
     * @return string
     */
    function format_throwable(\Throwable $throwable): string
    {
        return DI()->get(FormatterInterface::class)->format($throwable);
    }
}

if (!function_exists('queue_push')) {
    /**
     * Push a job to async queue.
     * @param JobInterface $job
     * @param int $delay
     * @param string $key
     * @return bool
     */
    function queue_push(JobInterface $job, int $delay = 0, string $key = 'default'): bool
    {
        $driver = DI()->get(DriverFactory::class)->get($key);
        return $driver->push($job, $delay);
    }
}