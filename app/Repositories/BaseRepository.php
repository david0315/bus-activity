<?php

namespace App\Repositories;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

class BaseRepository
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
        $this->logger = $loggerFactory->get('repository', 'default');
    }

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
//                if (!isset($dbData->$key)) {
//                    $diffData[$key] = $item;
//                }
                if (isset($dbData->$key) && $dbData->$key != $item) {
                    $diffData[$key] = $item;
                }
            } else {
//                if (!isset($dbData[$key])) {
//                    $diffData[$key] = $item;
//                }
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