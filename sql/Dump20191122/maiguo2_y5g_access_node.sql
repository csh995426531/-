-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: maiguo2
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
-- Table structure for table `y5g_access_node`
--

DROP TABLE IF EXISTS `y5g_access_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `y5g_access_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '方法',
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '权限名',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级id 0为1级',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='权限节点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `y5g_access_node`
--

LOCK TABLES `y5g_access_node` WRITE;
/*!40000 ALTER TABLE `y5g_access_node` DISABLE KEYS */;
INSERT INTO `y5g_access_node` VALUES (2,'index','members','updatepwd','密码修改',4,0,0),(3,'index','members','updateaccess','权限修改',4,0,0),(4,'','','','角色管理',0,0,0),(5,'','','','库存查询',0,0,0),(6,'index','item','inventory','在库查询',5,0,0),(7,'index','item','search','综合查询',5,0,0),(8,'','','','产品入库',0,0,0),(9,'index','item','income','进货入库',8,0,0),(10,'index','item','returnincome','退货入库',8,0,0),(11,'','','','产品出库',0,0,0),(12,'index','item','outgo','销售出库',11,0,0),(13,'','','','操作审核',0,0,0),(14,'index','item','incomeagree','入库审核',13,0,0),(15,'index','item','outgoagree','出库审核',13,0,0),(16,'','','','统计功能',0,0,0),(18,'index','statistics','profit','统计',16,0,0),(19,'','','','基础设置',0,0,0),(20,'index','setting','category','类别录入',19,0,0),(21,'index','setting','name','名称录入',19,0,0),(22,'index','setting','feature','配置录入',19,0,0),(23,'index','setting','appearance','外观录入',19,0,0),(24,'index','setting','edition','固件版本录入',19,0,0),(25,'index','setting','type','型号录入',19,0,0),(26,'index','setting','incomechannel','进货渠道录入',19,0,0),(27,'index','setting','outgochannel','出货途径录入',19,0,0),(28,'','','','日志查询',0,0,0),(29,'index','log','index','日志查询',28,0,0),(30,'index','setting','network','网络模式录入',19,0,0),(31,'index','item','specialoutgo','特殊出库',11,0,0);
/*!40000 ALTER TABLE `y5g_access_node` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-22 20:01:39
