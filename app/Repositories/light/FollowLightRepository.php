<?php

namespace App\Repositories\light;

use App\Amqp\Producers\FollowLightDealProducer;
use App\Constants\ConstData;
use App\Constants\ErrorCode;
use App\Exception\QueryException;
use App\Repositories\BaseRepository;
use App\Services\light\FollowLightService;
use App\Services\light\FollowLightVoteService;
use App\Utils\TimeUtils;
use Hyperf\Amqp\Producer;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;

class FollowLightRepository extends BaseRepository
{
    /**
     * @Inject()
     * @var FollowLightService
     */
    private $followLightService;

    /**
     * @Inject()
     * @var FollowLightVoteService
     */
    private $followLightVoteService;

    public function vote($accountId, $lightId, $vote){
        if(empty($accountId) || empty($lightId)){
            throw new QueryException(ErrorCode::PARAM_ERROR);
        }
        if(empty(intval($vote))){
            throw new QueryException(ErrorCode::PARAM_ERROR);
        }
        try{
            $currentTime = TimeUtils::currentDateTime();
            if(($currentTime >= ConstData::FOLLOW_LIGHT_FIRST_START_TIME && $currentTime <= ConstData::FOLLOW_LIGHT_FIRST_END_TIME) ||
                ($currentTime >= ConstData::FOLLOW_LIGHT_SECOND_START_TIME && $currentTime <= ConstData::FOLLOW_LIGHT_SECOND_END_TIME) ||
                ($currentTime >= ConstData::FOLLOW_LIGHT_THIRD_START_TIME && $currentTime <= ConstData::FOLLOW_LIGHT_THIRD_END_TIME) ||
                ($currentTime >= ConstData::FOLLOW_LIGHT_FOUR_START_TIME && $currentTime <= ConstData::FOLLOW_LIGHT_FOUR_END_TIME)
            ){

                $lightInfo = $this->followLightService->findFollowLight($lightId, ['light_id', 'light_name']);
                if(empty($lightInfo)){
                    throw new QueryException(ErrorCode::PARAM_ERROR); # 粉丝不存在
                }
                $followLightVote = $this->followLightVoteService->create([
                    'light_id' => $lightId,
                    'account_id' => $accountId,
                    'vote' => $vote,
                    'is_deal' => 0
                ]);
                # 【rabbitmq 队列】
                if(isset($followLightVote['vote_id'])){
                    $producer = ApplicationContext::getContainer()->get(Producer::class)->produce(new FollowLightDealProducer($followLightVote['vote_id']));
                }

                # 给 追光着添加 积分 【redis 队列】
//                queue_push(new FollowLightDealJob([
//                    'timestamp' => TimeUtils::currentMicroTimestamp(), # 多添加了一个参数，原因：可能是传入的参数一样，造成框架生成的key，之前的队列被覆盖
//                    'vote_id' => $followLightVote['vote_id'],
//                ]));
                return true;
            }else{
                throw new QueryException(ErrorCode::PARAM_ERROR);
            }

        }catch (QueryException $e){
            Db::rollBack();
            $this->logger->error($e->getMessage());
            throw new QueryException($e->getCode());
        }catch (\Exception $e){
            Db::rollBack();
            $this->logger->error($e->getMessage());
            throw new QueryException(ErrorCode::PARAM_ERROR);
        }
    }
}