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
-- Table structure for table `y5g_item`
--

DROP TABLE IF EXISTS `y5g_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `y5g_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类别id',
  `name_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '名称id',
  `feature_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '配置id',
  `appearance_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外观id',
  `edition_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '固件版本id',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '型号id',
  `date` date NOT NULL COMMENT '进货时间',
  `number` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '序列号',
  `memo` varchar(1000) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '备注',
  `price` decimal(18,4) unsigned NOT NULL DEFAULT '0.0000' COMMENT '价格',
  `channel_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '进货渠道id',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1:入库待审核 2:在库 3已售 4维修 5丢失 6入库审核失败 7出库待审核',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `network_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '网络模式id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='物品库存表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `y5g_item`
--

LOCK TABLES `y5g_item` WRITE;
/*!40000 ALTER TABLE `y5g_item` DISABLE KEYS */;
INSERT INTO `y5g_item` VALUES (1,1,1,1,1,1,1,'2019-07-06','20190604-0001','第一个商品',1798.0000,1,2,1562387359,1562387398,0),(2,1,1,2,1,1,1,'2019-07-07','20190604-0002','第二个商品',2399.0000,1,2,1562467532,1562467539,0),(3,1,1,1,1,1,0,'2019-07-07','20190604-001','',1798.0000,1,2,1562500728,1562501050,0),(4,1,1,1,1,1,1,'2019-07-08','20190604-002','',1798.0000,1,1,1562596103,1562596103,0),(5,1,2,3,2,2,0,'2019-07-08','20190604-003','',1798.0000,1,1,1562596135,1562596135,0),(6,1,2,3,2,2,0,'2019-07-08','20190604-004','',1798.0000,1,1,1562596715,1562596715,2);
/*!40000 ALTER TABLE `y5g_item` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-09  2:50:27
