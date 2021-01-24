<?php

namespace App\Services\light;

use App\Constants\ErrorCode;
use App\Exception\QueryException;
use App\Models\light\FollowLightVote;
use App\Services\BaseService;
use App\Utils\CommonUtils;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

class FollowLightVoteService extends BaseService
{
    /**
     * @Inject()
     * @var FollowLightVote
     */
    private $followLightVoteModel;

    public function create(array $options){
        $this->followLightVoteModel = new FollowLightVote();
        $this->serialization($options);
        try {
            Db::beginTransaction();
            $this->followLightVoteModel->save();
            Db::commit();
            return $this->followLightVoteModel->toArray();
        } catch (\Exception $e) {
            Db::rollBack();
            $this->logger->error($e->getMessage());
            throw new QueryException(ErrorCode::FOLLOW_LIGHT_VOTE_CREATE);
        }
    }

    protected function serialization(array $attributes)
    {
        // TODO: Implement serialization() method.
        $this->followLightVoteModel->light_id = CommonUtils::arrayGet($attributes, 'light_id', 0);
        $this->followLightVoteModel->account_id = CommonUtils::arrayGet($attributes, 'account_id', 0);
        $this->followLightVoteModel->vote = CommonUtils::arrayGet($attributes, 'vote', 0);
    }
}