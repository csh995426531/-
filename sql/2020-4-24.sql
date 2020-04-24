INSERT INTO `maiguo2`.`y5g_access_node`(`id`, `module`, `controller`, `action`, `name`, `parent_id`, `create_time`, `update_time`) VALUES (32, 'index', 'setting', 'specialedititemlist', '特殊修改', 19, 0, 0);
INSERT INTO `maiguo2`.`y5g_access_node`(`id`, `module`, `controller`, `action`, `name`, `parent_id`, `create_time`, `update_time`) VALUES (33, 'index', 'setting', 'intelligence', '智能识别码录入', 19, 0, 0);
CREATE TABLE `y5g_item_intelligence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '型号id',
  `feature_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '配置id',
  `appearance_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外观id',
  `data` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '识别码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1正常 2失效',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='智能识别码表';