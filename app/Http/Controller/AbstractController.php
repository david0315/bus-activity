<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Kernel\Http\Response;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;

abstract class AbstractController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var Response
     */
    protected $response;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    protected $limit = 15;

    public function __construct(LoggerFactory $loggerFactory, ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = $container->get(RequestInterface::class);
        $this->response = $container->get(Response::class);
        $this->logger = $loggerFactory->get('controller', 'default');
    }

    public function getCache()
    {
        return ApplicationContext::getContainer()->get(CacheInterface::class);
    }

    public function parsePage($page){
        if(empty($page) || $page <= 0) {
            $page = 1;
        }
        return $page;
    }

    public function parseLimit($limit){
        if(empty($limit) || $limit <= 0){
            $limit = $this->limit;
        }
        return $limit;
    }

}
