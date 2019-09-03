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
-- Table structure for table `y5g_item_type`
--

DROP TABLE IF EXISTS `y5g_item_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `y5g_item_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类别id',
  `name_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '名称id',
  `network_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '网络模式id',
  `data` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1正常 2失效',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='型号表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `y5g_item_type`
--

LOCK TABLES `y5g_item_type` WRITE;
/*!40000 ALTER TABLE `y5g_item_type` DISABLE KEYS */;
INSERT INTO `y5g_item_type` VALUES (1,1,1,1,'A8786',1,1562384966,1562384966);
/*!40000 ALTER TABLE `y5g_item_type` ENABLE KEYS */;
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
