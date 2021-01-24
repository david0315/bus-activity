<?php

namespace App\Services\light;

use App\Constants\ErrorCode;
use App\Exception\QueryException;
use App\Models\light\FollowLight;
use App\Services\BaseService;
use App\Utils\TimeUtils;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

class FollowLightService extends BaseService
{
    /**
     * @Inject()
     * @var FollowLight
     */
    private $followLightModel;

    public function followLights($selectField = []){
        if ($selectField === '*' || empty($selectField)) {
            $selectField = $this->followLightModel->attributeLabels;
        }
        return $this->followLightModel->query()->select($selectField)->orderByDesc('four_light_vote')->get();
    }

    /**
     * @param $lightId
     * @param array $selectField
     * @return FollowLight|null
     */
    public function findFollowLight($lightId, $selectField = []):?object{
        if(empty($lightId)){
            return null;
        }
        if ($selectField === '*' || empty($selectField)) {
            $selectField = $this->followLightModel->attributeLabels;
        }
        return $this->followLightModel->query()->select($selectField)->find($lightId);
    }

    /**
     * 投票
     * @param $lightObject
     * @param $firstTime
     * @param $secondTime
     * @param $thirdTime
     * @param $fourTime
     * @param int $vote
     * @return bool
     */
    public function changeLightVote($lightObject, $firstTime, $secondTime, $thirdTime, $fourTime, $vote = 1){
        $lightObject = $this->lightObject($lightObject);
        try{
            $currentTime = TimeUtils::currentTimestamp();
            $lightObject->vote += $vote;
            if($currentTime < $firstTime){
                $lightObject->first_light_vote += $vote;
            }
            if($currentTime < $secondTime){
                $lightObject->second_light_vote += $vote;
            }
            if($currentTime < $thirdTime){
                $lightObject->third_light_vote += $vote;
            }
            if($currentTime < $fourTime){
                $lightObject->four_light_vote += $vote;
            }
            Db::beginTransaction();
            $lightObject->save();
            Db::commit();
            return true;
        }catch (\Exception $e){
            Db::rollBack();
            $this->logger->error($e->getMessage());
            throw new QueryException(ErrorCode::FOLLOW_LIGHT_CHANGE_VOTE);
        }
    }

    /**
     * @param $lightObject
     * @return FollowLight|null
     */
    private function lightObject(&$lightObject):?object{
        if(!$lightObject instanceof FollowLight){
            throw new QueryException(ErrorCode::FOLLOW_LIGHT_NOT_EXISTS);
        }
        return $lightObject;
    }

    protected function serialization(array $attributes)
    {
        // TODO: Implement serialization() method.
    }
}