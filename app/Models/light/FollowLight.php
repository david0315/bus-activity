<?php

namespace App\Models\light;

use App\Models\BaseModel;

/**
 * Class FollowLight
 * @property int $light_id
 * @property string $light_name
 * @property string $light_mobile
 * @property string $light_avatar
 * @property string $avatar
 * @property int $vote
 * @property int $first_light_vote
 * @property string $first_light_link
 * @property int $second_light_vote
 * @property string $second_light_link
 * @property int $third_light_vote
 * @property int $four_light_vote
 * @property \Carbon\Carbon $created_at
 * @package App\Models\light
 */
class FollowLight extends BaseModel
{
    protected $table = 'follow_light';
    public $primaryKey = 'light_id';
    public const UPDATED_AT = null;

    public $attributeLabels = [
        'light_id',
        'light_name',
        'light_mobile',
        'light_avatar',
        'avatar',
        'vote',
        'first_light_vote',
        'first_light_link',
        'second_light_vote',
        'second_light_link',
        'third_light_vote',
        'four_light_vote',
        'created_at'
    ];
}