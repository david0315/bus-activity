<?php

namespace App\Amqp\Consumers;

use App\Cache\FollowLightDealCache;
use App\Constants\ConstData;
use App\Constants\ErrorCode;
use App\Utils\Logger;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;
use Hyperf\DbConnection\Db;

/**
 *
 * Class FollowLightDealConsumer
 * @package App\Amqp\Consumers
 *
 * @Consumer(exchange="bus-follow-light-exchange", routingKey="bus-follow-light-routing-key", queue="bus-follow-light-queue", nums=1, enable=false))
 */
class FollowLightDealConsumer extends ConsumerMessage
{
    public function consume($data): string
    {
        $voteId = $data['data']['vote_id'] ?? 0;
//        return $this->dbChangeFollowLightVote($voteId);
    }

    public function isEnable(): bool
    {
        return parent::isEnable();
    }

    /***
     * @param $voteId
     * @return int|string
     */
    public function dbChangeFollowLightVote($voteId){
        if(empty($voteId)){
            return ErrorCode::OK;
        }
        try{
            $lightVoteObject = Db::table('follow_light_vote')->where('vote_id', $voteId)->limit(1)->first();
            if(empty($lightVoteObject)){
                return ErrorCode::OK;
            }
            if($lightVoteObject->is_deal == 1){
                return ErrorCode::OK;
            }
            $currentTime = $lightVoteObject->created_at;
            $updatedData['vote'] = DB::raw('`vote` + ' . $lightVoteObject->vote);
            if($currentTime >= ConstData::FOLLOW_LIGHT_FIRST_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_FIRST_END_TIME){
                $updatedData['first_light_vote'] = DB::raw('`first_light_vote` + ' . $lightVoteObject->vote);
            }
            if($currentTime >= ConstData::FOLLOW_LIGHT_SECOND_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_SECOND_END_TIME){
                $updatedData['second_light_vote'] = DB::raw('`second_light_vote` + ' . $lightVoteObject->vote);
            }
            if($currentTime >= ConstData::FOLLOW_LIGHT_THIRD_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_THIRD_END_TIME){
                $updatedData['third_light_vote'] = DB::raw('`third_light_vote` + ' . $lightVoteObject->vote);
            }
            if($currentTime >= ConstData::FOLLOW_LIGHT_FOUR_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_FOUR_END_TIME){
                $updatedData['four_light_vote'] = DB::raw('`four_light_vote` + ' . $lightVoteObject->vote);
            }
            Db::beginTransaction();
            Db::table('follow_light_vote')->where('vote_id', $voteId)->update(['is_deal' => 1]);
            Db::table('follow_light')->where('light_id', $lightVoteObject->light_id)->update($updatedData);
            Db::commit();
            return Result::ACK;
        }catch (\Exception $e){
            Db::rollBack();
            Logger::get('follow-light-deal-vote')->error($e->getMessage());
            return Result::ACK;
        }
    }

    public function redisChangeFollowLightVote($voteId){
        if(empty($voteId)){
            return ErrorCode::OK;
        }
        try{
            $lightVoteObject = Db::table('follow_light_vote')->where('vote_id', $voteId)->limit(1)->first();
            if(empty($lightVoteObject)){
                return ErrorCode::OK;
            }
            if($lightVoteObject->is_deal == 1){
                return ErrorCode::OK;
            }
            $currentTime = $lightVoteObject->created_at;
            $updatedData['vote'] = DB::raw('`vote` + ' . $lightVoteObject->vote);
            $firstVote = 0;
            $secondVote = 0;
            $thirdVote = 0;
            $fourVote = 0;
            if($currentTime >= ConstData::FOLLOW_LIGHT_FIRST_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_FIRST_END_TIME){
                $updatedData['first_light_vote'] = DB::raw('`first_light_vote` + ' . $lightVoteObject->vote);
                $firstVote = $lightVoteObject->vote;
            }
            if($currentTime >= ConstData::FOLLOW_LIGHT_SECOND_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_SECOND_END_TIME){
                $updatedData['second_light_vote'] = DB::raw('`second_light_vote` + ' . $lightVoteObject->vote);
                $secondVote = $lightVoteObject->vote;
            }
            if($currentTime >= ConstData::FOLLOW_LIGHT_THIRD_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_THIRD_END_TIME){
                $updatedData['third_light_vote'] = DB::raw('`third_light_vote` + ' . $lightVoteObject->vote);
                $thirdVote = $lightVoteObject->vote;
            }
            if($currentTime >= ConstData::FOLLOW_LIGHT_FOUR_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_FOUR_END_TIME){
                $updatedData['four_light_vote'] = DB::raw('`four_light_vote` + ' . $lightVoteObject->vote);
                $fourVote = $lightVoteObject->vote;
            }
            FollowLightDealCache::followLightIncrVote($lightVoteObject->light_id, $lightVoteObject->vote, $firstVote, $secondVote, $thirdVote, $fourVote);
//            Db::beginTransaction();
            Db::table('follow_light_vote')->where('vote_id', $voteId)->update(['is_deal' => 1]);
//            Db::table('follow_light')->where('light_id', $lightVoteObject->light_id)->update($updatedData);
//            Db::commit();
            return Result::ACK;
        }catch (\Exception $e){
            Db::rollBack();
            Logger::get('follow-light-deal-vote')->error($e->getMessage());
            return Result::ACK;
//            throw new QueryException(ErrorCode::ACCOUNT_LOGIN_RECORD_CREATE, $e->getMessage());
        }
    }

}
