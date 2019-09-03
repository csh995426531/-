ALTER TABLE `maiguo`.`y5g_item` ADD COLUMN `network_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '网络模式id' AFTER `update_time`;
UPDATE `maiguo`.`y5g_access_node` SET `name` = '销售出库' WHERE (`id` = '12');
INSERT INTO `maiguo`.`y5g_access_node` (`id`, `module`, `controller`, `action`, `name`, `parent_id`, `create_time`, `update_time`) VALUES ('31', 'index', 'item', 'specialoutgo', '特殊出库', '11', '0', '0');
DELETE FROM `maiguo`.`y5g_access_node` WHERE (`id` = '17');
UPDATE `maiguo`.`y5g_access_node` SET `name` = '统计' WHERE (`id` = '18');