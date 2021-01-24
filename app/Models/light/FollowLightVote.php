<?php

namespace App\Models\light;

use App\Models\BaseModel;
/**
 * Class FollowLightVote
 * @property int $vote_id
 * @property int $light_id
 * @property int $account_id
 * @property int $vote
 * @property int $is_deal
 * @property int $created_at
 * @package App\Models\light
 */
class FollowLightVote extends BaseModel
{
    protected $table = 'follow_light_vote';
    public $primaryKey = 'vote_id';

    public const UPDATED_AT = null;

    public $attributeLabels = [
        'vote_id',
        'light_id',
        'account_id',
        'vote',
        'is_deal',
        'created_at',
    ];
}