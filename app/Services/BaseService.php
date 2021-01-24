<?php

namespace App\Services;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

abstract class BaseService
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    protected $limit = 15;

    public function __construct(LoggerFactory $loggerFactory, ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $loggerFactory->get('service', 'default');
    }

    /**
     * 序列化模型实例
     *
     * @param array $attributes
     * @return mixed
     */
    abstract protected function serialization(array $attributes);

    /**
     * 比较差异
     * @param $requestData
     * @param $dbData
     * @return array
     */
    public function diffData(&$requestData, &$dbData)
    {
        $diffData = [];
        foreach ($requestData as $key => $item) {
            if (is_object($dbData)) {
                if ((isset($dbData->$key) || is_null($dbData->$key)) && $dbData->$key != $item) {
                    $diffData[$key] = $item;
                }
            } else {
                if (isset($dbData[$key]) && $dbData[$key] != $item) {
                    $diffData[$key] = $item;
                }
            }
        }
        return $diffData;
    }

    /**
     * 三维数组 差异比较
     * @param $requestData
     * @param $dbData
     * @return array
     */
    public function diffMultiData(&$requestData, &$dbData)
    {
        $diffData = [];
        foreach ($requestData as $key => $item) {
            if (is_object($dbData)) {
                if (!isset($dbData->$key)) {
                    $diffData[$key] = $item;
                }
                if (isset($dbData->$key) && $dbData->$key != $item) {
                    $diffData[$key] = $item;
                }
            } else {
                if (!isset($dbData[$key])) {
                    $diffData[$key] = $item;
                }
                if (isset($dbData[$key]) && $dbData[$key] != $item) {
                    $diffData[$key] = $item;
                }
            }
        }
        return $diffData;
    }




}