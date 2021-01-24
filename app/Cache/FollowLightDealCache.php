<?php

namespace App\Cache;

use App\Constants\RedisKeys;

class FollowLightDealCache
{
    const BUS_STR_FOLLOW_LIGHT_VOTE = RedisKeys::BUS_STR_FOLLOW_LIGHT_VOTE;
    const BUS_STR_FOLLOW_LIGHT_FIRST_VOTE = RedisKeys::BUS_STR_FOLLOW_LIGHT_FIRST_VOTE;
    const BUS_STR_FOLLOW_LIGHT_SECOND_VOTE = RedisKeys::BUS_STR_FOLLOW_LIGHT_SECOND_VOTE;
    const BUS_STR_FOLLOW_LIGHT_THIRD_VOTE = RedisKeys::BUS_STR_FOLLOW_LIGHT_THIRD_VOTE;
    const BUS_STR_FOLLOW_LIGHT_FOUR_VOTE = RedisKeys::BUS_STR_FOLLOW_LIGHT_FOUR_VOTE;

    public static function followLightIncrVote($lightId, $vote, $firstVote, $secondVote, $thirdVote, $fourVote){
        $pipe = redis()->multi(\Redis::PIPELINE);
        if($vote > 0){
            $pipe->incrby(self::BUS_STR_FOLLOW_LIGHT_VOTE.$lightId, $vote);
        }
        if($firstVote > 0){
            $pipe->incrby(self::BUS_STR_FOLLOW_LIGHT_FIRST_VOTE.$lightId, $firstVote);
        }
        if($secondVote > 0){
            $pipe->incrby(self::BUS_STR_FOLLOW_LIGHT_SECOND_VOTE.$lightId, $secondVote);
        }
        if($thirdVote > 0){
            $pipe->incrby(self::BUS_STR_FOLLOW_LIGHT_THIRD_VOTE.$lightId, $thirdVote);
        }
        if($fourVote > 0){
            $pipe->incrby(self::BUS_STR_FOLLOW_LIGHT_FOUR_VOTE.$lightId, $fourVote);
        }
        return $pipe->exec();
    }

    public static function followLightDelVote($lightId){
        $pipe = redis()->multi(\Redis::PIPELINE);
        $pipe->del(self::BUS_STR_FOLLOW_LIGHT_VOTE.$lightId);
        $pipe->del(self::BUS_STR_FOLLOW_LIGHT_FIRST_VOTE.$lightId);
        $pipe->del(self::BUS_STR_FOLLOW_LIGHT_SECOND_VOTE.$lightId);
        $pipe->del(self::BUS_STR_FOLLOW_LIGHT_THIRD_VOTE.$lightId);
        $pipe->del(self::BUS_STR_FOLLOW_LIGHT_FOUR_VOTE.$lightId);
        return $pipe->exec();
    }
}