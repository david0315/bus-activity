CREATE TABLE `t_follow_light` (
  `light_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `light_name` varchar(100) NOT NULL DEFAULT '' COMMENT '姓名',
  `light_mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `light_avatar` varchar(150) NOT NULL DEFAULT '' COMMENT '头像',
  `avatar` varchar(150) NOT NULL DEFAULT '' COMMENT '列表头像',
  `vote` int unsigned NOT NULL DEFAULT '0' COMMENT '投票总额',
  `first_light_vote` int unsigned NOT NULL DEFAULT '0' COMMENT '第一站点亮的票数',
  `first_light_link` varchar(150) NOT NULL DEFAULT '' COMMENT '第一站点亮的链接',
  `second_light_vote` int unsigned NOT NULL DEFAULT '0' COMMENT '第二站点亮的票数',
  `second_light_link` varchar(150) NOT NULL DEFAULT '' COMMENT '第二站点亮的链接',
  `third_light_vote` int unsigned NOT NULL DEFAULT '0' COMMENT '第三站点亮的票数',
  `four_light_vote` int unsigned NOT NULL DEFAULT '0' COMMENT '第四站点亮的票数',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '录入时间',
  PRIMARY KEY (`light_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='追光者'



CREATE TABLE `t_follow_light_vote` (
  `vote_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `light_id` int unsigned NOT NULL DEFAULT '0',
  `account_id` int unsigned NOT NULL DEFAULT '0',
  `vote` int unsigned NOT NULL DEFAULT '0' COMMENT '投票',
  `is_deal` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '消息队列-是否处理',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '录入时间',
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59271 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='追光者-被投票数记录'