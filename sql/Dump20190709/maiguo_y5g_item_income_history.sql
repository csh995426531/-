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
-- Table structure for table `y5g_item_income_history`
--

DROP TABLE IF EXISTS `y5g_item_income_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `y5g_item_income_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) unsigned NOT NULL COMMENT '类型 1:进货入库 2:退货入库',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存id',
  `outgo_history_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '出库记录',
  `create_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '录入人id',
  `status` tinyint(2) unsigned NOT NULL COMMENT '状态 1:待审核 2:审核通过 3:审核失败',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='入库历史';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `y5g_item_income_history`
--

LOCK TABLES `y5g_item_income_history` WRITE;
/*!40000 ALTER TABLE `y5g_item_income_history` DISABLE KEYS */;
INSERT INTO `y5g_item_income_history` VALUES (1,1,1,0,1,2,1562387359,1562387398),(2,1,2,0,1,2,1562467532,1562467539),(3,1,3,0,1,2,1562500728,1562501050),(4,1,4,0,1,1,1562596103,1562596103),(5,1,5,0,1,1,1562596135,1562596135),(6,1,6,0,1,1,1562596715,1562596715);
/*!40000 ALTER TABLE `y5g_item_income_history` ENABLE KEYS */;
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
