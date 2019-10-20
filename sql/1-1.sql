CREATE TABLE `maiguo2`.`y5g_item_history` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `event` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '事件{1:进货入库,2:进货审核,3:销售出库,4:销售审核,5:退货入库,6:退货审核}',
  `event_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '事件id',
  `result` TINYINT(2) UNSIGNED NOT NULL COMMENT '事件结果{1:成功,2:失败}' AFTER `event_id`,
  `create_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`));
ALTER TABLE `maiguo2`.`y5g_item_history` 
ADD INDEX `IDX_ITEM_ID` USING BTREE (`item_id`);
ALTER TABLE `maiguo2`.`y5g_item_income_history` 
ADD COLUMN `update_user_id` INT(10) UNSIGNED NOT NULL COMMENT '审核人' AFTER `update_time`;
ALTER TABLE `maiguo2`.`y5g_item_outgo_history` 
ADD COLUMN `update_user_id` INT(10) UNSIGNED NOT NULL COMMENT '审核人' AFTER `cost`;
