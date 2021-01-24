<?php
/*
                   .::::.
                 .::::::::.
                :::::::::::  FUCK YOU
            ..:::::::::::'
          '::::::::::::'
            .::::::::::
       '::::::::::::::..
            ..::::::::::::.
          ``::::::::::::::::
           ::::``:::::::::'        .:::.
          ::::'   ':::::'       .::::::::.
        .::::'      ::::     .:::::::'::::.
       .:::'       :::::  .:::::::::' ':::::.
      .::'        :::::.:::::::::'      ':::::.
     .::'         ::::::::::::::'         ``::::.
 ...:::           ::::::::::::'              ``::.
````':.          ':::::::::'                  ::::..
                   '.:::::'                    ':'````..
*/
declare(strict_types=1);

namespace App\Constants;
/**
 * Class ConstData
 * @package App\Constants
 * Date: 17/7/18
 * Time: 15:11
 * Author: david.li
 */
class ConstData
{
    CONST FIRST_LIGHTEN_LIGHT = '2020-12-31 20:00:00';
    CONST SECOND_LIGHTEN_LIGHT = '2021-01-20 20:00:00';
    CONST THREE_LIGHTEN_LIGHT = '2021-02-02 11:59:00';
    const FOLLOW_LIGHT_FIRST_START_TIME = '2020-12-31 00:00:00';

//    const FOLLOW_LIGHT_FIRST_END_TIME = '2021-01-07 23:00:00';
//    const FOLLOW_LIGHT_FIRST_DISABLE_START_TIME = '2021-01-07 23:00:01';
//    const FOLLOW_LIGHT_FIRST_DISABLE_END_TIME = '2021-01-07 23:03:59';

    const FOLLOW_LIGHT_FIRST_END_TIME = '2021-01-08 20:00:00';
    const FOLLOW_LIGHT_FIRST_DISABLE_START_TIME = '2021-01-08 20:00:01';
    const FOLLOW_LIGHT_FIRST_DISABLE_END_TIME = '2021-01-09 11:59:59';
    const FOLLOW_LIGHT_FIRST_VOTE = 100000; # 100000

    # 第二阶段时间：2021年1月9日12点至2021年1月20日20点——（允许投票时间）
    # 第二阶段停车加油时间：2021年1月20日20点—2021年1月21日11点59分——（禁止投票时间）

//    const FOLLOW_LIGHT_SECOND_START_TIME = '2021-01-07 23:04:00'; #
    const FOLLOW_LIGHT_SECOND_START_TIME = '2021-01-09 12:00:00'; #
    const FOLLOW_LIGHT_SECOND_END_TIME = '2021-01-20 20:00:00'; #
    const FOLLOW_LIGHT_SECOND_DISABLE_START_TIME = '2021-01-20 20:00:00'; #
    const FOLLOW_LIGHT_SECOND_DISABLE_END_TIME = '2021-01-21 11:59:59'; #
    const FOLLOW_LIGHT_SECOND_VOTE = 200000; # 200000

    # 第三阶段时间：2021年1月21日12点至2021年2月1日20点——（允许投票时间）
    # 第三阶段停车加油时间：2021年2月1日20点—2021年2月2日11点59分——（禁止投票时间）
    const FOLLOW_LIGHT_THIRD_START_TIME = '2021-01-21 12:00:00'; #
    const FOLLOW_LIGHT_THIRD_END_TIME = '2021-02-01 20:00:00'; #
    const FOLLOW_LIGHT_THIRD_DISABLE_START_TIME = '2021-02-01 20:00:00'; #
    const FOLLOW_LIGHT_THIRD_DISABLE_END_TIME = '2021-02-02 11:59:59'; #
    const FOLLOW_LIGHT_THIRD_VOTE = 600000; # 500000

    # 第四阶段时间：2021年2月2日12点至总决算播出前一日为止
    const FOLLOW_LIGHT_FOUR_START_TIME = '2021-02-02 12:00:00'; #
    const FOLLOW_LIGHT_FOUR_END_TIME = '2021-02-27 00:00:00'; #
    const FOLLOW_LIGHT_FOUR_DISABLE_START_TIME = '2021-02-27 00:00:00'; #
    const FOLLOW_LIGHT_FOUR_DISABLE_END_TIME = '2022-02-27 00:00:00'; #
    const FOLLOW_LIGHT_FOUR_VOTE = 15000000; # 10000000




//    CONST FIRST_LIGHTEN_LIGHT = '2020-12-30 20:05:00'; # 2020-12-30 19:35:00
//    CONST SECOND_LIGHTEN_LIGHT = '2020-12-30 20:10:00'; # 2020-12-30 19:40:00
//    CONST THREE_LIGHTEN_LIGHT = '2020-12-30 20:15:00'; # 2020-12-30 19:45:00
//
//    const FOLLOW_LIGHT_FIRST_START_TIME = '2020-12-30 20:00:00'; # 2020-12-30 19:30:00
//    const FOLLOW_LIGHT_FIRST_END_TIME = '2020-12-30 20:05:59'; # 2020-12-30 19:35:00
//    const FOLLOW_LIGHT_FIRST_DISABLE_START_TIME = '2020-12-30 20:06:00'; # 2020-12-30 19:35:00
//    const FOLLOW_LIGHT_FIRST_DISABLE_END_TIME = '2020-12-30 20:08:59'; # 2020-12-30 19:37:00
//    const FOLLOW_LIGHT_FIRST_VOTE = 100000; # 100000
//
//    # 第二阶段时间：2021年1月9日12点至2021年1月20日20点——（允许投票时间）
//    # 第二阶段停车加油时间：2021年1月20日20点—2021年1月21日11点59分——（禁止投票时间）
//    const FOLLOW_LIGHT_SECOND_START_TIME = '2020-12-30 20:09:00'; # 2020-12-30 19:37:00
//    const FOLLOW_LIGHT_SECOND_END_TIME = '2020-12-30 20:14:59'; # 2020-12-30 19:42:00
//    const FOLLOW_LIGHT_SECOND_DISABLE_START_TIME = '2020-12-30 20:15:00'; # 2020-12-30 19:42:00
//    const FOLLOW_LIGHT_SECOND_DISABLE_END_TIME = '2020-12-30 20:17:59'; # 2020-12-30 19:44:00
//    const FOLLOW_LIGHT_SECOND_VOTE = 200000; # 200000
//
//    # 第三阶段时间：2021年1月21日12点至2021年2月1日20点——（允许投票时间）
//    # 第三阶段停车加油时间：2021年2月1日20点—2021年2月2日11点59分——（禁止投票时间）
//    const FOLLOW_LIGHT_THIRD_START_TIME = '2020-12-30 20:18:00'; # 2020-12-30 19:44:00
//    const FOLLOW_LIGHT_THIRD_END_TIME = '2020-12-30 20:23:59'; # 2020-12-30 19:49:00
//    const FOLLOW_LIGHT_THIRD_DISABLE_START_TIME = '2020-12-30 20:24:00'; # 2020-12-30 19:49:00
//    const FOLLOW_LIGHT_THIRD_DISABLE_END_TIME = '2020-12-30 20:26:59'; #
//    const FOLLOW_LIGHT_THIRD_VOTE = 600000; # 500000
//
//    # 第四阶段时间：2021年2月2日12点至总决算播出前一日为止
//    const FOLLOW_LIGHT_FOUR_START_TIME = '2020-12-30 20:27:00'; #
//    const FOLLOW_LIGHT_FOUR_END_TIME = '2020-12-30 20:32:59'; #
//    const FOLLOW_LIGHT_FOUR_DISABLE_START_TIME = '2021-02-27 20:33:00'; # 2021-02-27 00:00:00
//    const FOLLOW_LIGHT_FOUR_DISABLE_END_TIME = '2022-02-27 20:35:00'; #
//    const FOLLOW_LIGHT_FOUR_VOTE = 15000000; # 10000000


//    const FOLLOW_LIGHT_FIRST_TIME = 1608011700; # 2020-12-15 13:55
//    const FOLLOW_LIGHT_FIRST_VOTE = 100000; # 100000
//
//    const FOLLOW_LIGHT_SECOND_TIME = 1608011880; # 2020-12-15 13:58
//    const FOLLOW_LIGHT_SECOND_VOTE = 200000; # 200000
//
//    const FOLLOW_LIGHT_THIRD_TIME = 1608011760; # 2020-12-15 13:56
//    const FOLLOW_LIGHT_THIRD_VOTE = 600000; # 500000
//
//    const FOLLOW_LIGHT_FOUR_TIME = 1639547940; # 2021-12-15 13:59
//    const FOLLOW_LIGHT_FOUR_VOTE = 15000000; # 10000000

}