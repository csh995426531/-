-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: maiguo
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `y5g_item_outgo_history`
--

DROP TABLE IF EXISTS `y5g_item_outgo_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `y5g_item_outgo_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存id',
  `date` date NOT NULL COMMENT '出库时间',
  `channel_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '出库途径id',
  `order_no` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '订单号',
  `consignee_nickname` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '收货人昵称',
  `consignee` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '收货人',
  `consignee_address` varchar(1000) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '收货人地址',
  `consignee_phone` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '收货人手机号',
  `price` decimal(18,4) unsigned NOT NULL DEFAULT '0.0000' COMMENT '销售价格',
  `memo` varchar(1000) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '备注',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1待审核 2审核通过 3审核失败 4退货',
  `create_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出库历史';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `y5g_item_outgo_history`
--

LOCK TABLES `y5g_item_outgo_history` WRITE;
/*!40000 ALTER TABLE `y5g_item_outgo_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `y5g_item_outgo_history` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-09  2:50:26
