<?php

declare(strict_types=1);

namespace App\Constants;
/**
 * Class RedisKeys
 * @package App\Constants
 * Date: 17/7/18
 * Time: 23:43
 * Author: david.li
 */
class RedisKeys
{
    # 短信验证码
    const COMMONALITY_SEND_SMS_CODE = 'bus:str:send:sms:code:';
    const MOBILE_SMS_LIMIT_KEY = 'bus:str:send:limit:';

    # 分享
    const TM_HASH_QR_CODE_INFO = 'bus:h:qr:info:'; # 二维码详情
    const TM_LIST_QR_ACCOUNT_CODE = 'bus:l:qr:account:id:'; # 用户分享的二维码
    const TM_BIT_QR_CODE_EXISTS = 'bus:bit:qr:exists:id:'; # 判断是否加入 redis 队列

    # 舞者投票
    const SORTED_SET_DANCER_VOTED_LIST_RECORD = 'bus:st:dancer:vote:'; # 舞者被投票排名
    const SORTED_SET_ACCOUNT_VOTE_DANCER_RECORD = 'bus:st:account:vote:dance:';# 粉丝投票的所有舞者的

    # 战队 - 综合榜
    const SORTED_SET_MULTIPLE_BUNCH_VOTE = 'bus:st:multiple:vote:';# 综合榜
    const SORTED_SET_BUNCH_ACCOUNT_VOTE_RECORD = 'bus:st:bunch:account:vote:'; # bunch 粉丝榜
    const SORTED_SET_MULTIPLE_BUNCH_ACCOUNT_VOTE_RECORD = 'bus:st:multiple:account:vote:bunch:';# bunch 战队
    const SORTED_SET_BUNCH_LABEL_ACCOUNT_VOTE_RECORD = 'bus:st:bunch:label:account:vote:'; # bunch 粉丝榜 - label

    # 有赞 token
//    const you_zan_string_sex_
    const BUS_STR_EXPIRED_ACCESS_TOKEN = 'bus:str:expired:access:token:';

    const BUS_STR_FOLLOW_LIGHT_VOTE = 'bus:str:follow:light:vote:';
    const BUS_STR_FOLLOW_LIGHT_FIRST_VOTE = 'bus:str:follow:light:first:vote:';
    const BUS_STR_FOLLOW_LIGHT_SECOND_VOTE = 'bus:str:follow:light:second:vote:';
    const BUS_STR_FOLLOW_LIGHT_THIRD_VOTE = 'bus:str:follow:light:third:vote:';
    const BUS_STR_FOLLOW_LIGHT_FOUR_VOTE = 'bus:str:follow:light:four:vote:';

}
