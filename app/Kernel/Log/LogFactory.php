<?php

namespace App\Kernel\Log;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Logger\LoggerFactory;

/**
 * Class LoggerFactory
 * @package App\Kernel\Log
 * Date: 3/12/19
 * Time: 16:52
 * Author: david.li
 */
class LogFactory
{
    /**
     * 文件日志
     * @param string $name
     * @return \Psr\Log\LoggerInterface
     */
    public static function get(string $name = 'app')
    {
        return DI()->get(LoggerFactory::class)->get($name);
    }

    /**
     * 控制台日志
     */
    public static function stdLog()
    {
        return DI()->get(StdoutLoggerInterface::class);
    }
}