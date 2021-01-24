<?php
namespace App\Kernel\Log;

class SeasLogFactory
{
    protected $log;

    public function __construct($path = 'log')
    {
        $this->log = make(\SeasLog::class);
        $this->log->setBasePath(BASE_PATH . '/runtime/logs/');
        $this->setLogger($path);
    }

    public function __call($name, $arguments)
    {
        return $this->log->{$name}(...$arguments);
    }

    public function setLogger($path = 'log')
    {
        $this->log->setLogger($path . '/' . date('Ym'));

        return $this;
    }
}