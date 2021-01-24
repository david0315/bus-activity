<?php

namespace App\Http\Controller\Api\V1\light;

use App\Constants\ConstData;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Http\Controller\AbstractController;
use App\Repositories\light\FollowLightRepository;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

class FollowLightController extends AbstractController
{
    public function __construct(LoggerFactory $loggerFactory, ContainerInterface $container)
    {
        parent::__construct($loggerFactory, $container);
    }

    /**
     * @Inject()
     * @var FollowLightRepository
     */
    protected $followLightRepository;

    public function followLights(){
        $list = $this->followLightRepository->followLights();
        return $this->response->success(['lights' => $list, 'setting' => [

            'first_lighten_light' => ConstData::FIRST_LIGHTEN_LIGHT,
            'second_lighten_light' => ConstData::SECOND_LIGHTEN_LIGHT,
            'three_lighten_light' => ConstData::THREE_LIGHTEN_LIGHT,

            'first_start_time' => ConstData::FOLLOW_LIGHT_FIRST_START_TIME,
            'first_end_time' => ConstData::FOLLOW_LIGHT_FIRST_END_TIME,
            'first_disable_start_time' => ConstData::FOLLOW_LIGHT_FIRST_DISABLE_START_TIME,
            'first_disable_end_time' => ConstData::FOLLOW_LIGHT_FIRST_DISABLE_END_TIME,
            'first_vote' => ConstData::FOLLOW_LIGHT_FIRST_VOTE,

            'second_start_time' => ConstData::FOLLOW_LIGHT_SECOND_START_TIME,
            'second_end_time' => ConstData::FOLLOW_LIGHT_SECOND_END_TIME,
            'second_disable_start_time' => ConstData::FOLLOW_LIGHT_SECOND_DISABLE_START_TIME,
            'second_disable_end_time' => ConstData::FOLLOW_LIGHT_SECOND_DISABLE_END_TIME,
            'second_vote' => ConstData::FOLLOW_LIGHT_SECOND_VOTE,

            'third_start_time' => ConstData::FOLLOW_LIGHT_THIRD_START_TIME,
            'third_end_time' => ConstData::FOLLOW_LIGHT_THIRD_END_TIME,
            'third_disable_start_time' => ConstData::FOLLOW_LIGHT_THIRD_DISABLE_START_TIME,
            'third_disable_end_time' => ConstData::FOLLOW_LIGHT_THIRD_DISABLE_END_TIME,
            'third_vote' => ConstData::FOLLOW_LIGHT_THIRD_VOTE,

            'four_start_time' => ConstData::FOLLOW_LIGHT_FOUR_START_TIME,
            'four_end_time' => ConstData::FOLLOW_LIGHT_FOUR_END_TIME,
            'four_disable_start_time' => ConstData::FOLLOW_LIGHT_FOUR_DISABLE_START_TIME,
            'four_disable_end_time' => ConstData::FOLLOW_LIGHT_FOUR_DISABLE_END_TIME,
            'four_vote' => ConstData::FOLLOW_LIGHT_FOUR_VOTE,
        ]]);
    }

    public function accountVotes(){
        $limit = $this->request->input('limit');
        $lightId = (int)$this->request->input('light_id', 0);
        if(empty($lightId)){
            throw new BusinessException(ErrorCode::PARAM_ERROR);
        }
        $list = $this->followLightRepository->followLightVotes($lightId, $limit);
        return $this->response->success($list);
    }

    public function vote(){
        $accountId = (int)$this->request->input('account_id', $this->request->getAttribute('account_id', 0));
        $lightId = (int)$this->request->input('light_id', 0);
        $vote = (int) $this->request->input('vote', 0);
        if(empty($accountId) || empty($lightId) || empty($vote)){
            throw new BusinessException(ErrorCode::PARAM_ERROR);
        }
        try{
            $ret = $this->followLightRepository->vote($accountId, $lightId, $vote);
            return $this->response->success($ret);
        }catch (\Exception $e){
            $this->logger->error($e->getMessage());
            throw new BusinessException($e->getCode());
        }
    }

}