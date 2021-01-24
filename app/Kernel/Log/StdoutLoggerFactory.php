<?php

namespace App\Kernel\Log;


use Psr\Container\ContainerInterface;

class StdoutLoggerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return LogFactory::get('sys');
    }
}