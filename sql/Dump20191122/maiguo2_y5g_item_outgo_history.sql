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
  `cost` decimal(18,4) unsigned NOT NULL COMMENT '营销成本',
  `update_user_id` int(10) unsigned NOT NULL COMMENT '审核人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='出库历史';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `y5g_item_outgo_history`
--

LOCK TABLES `y5g_item_outgo_history` WRITE;
/*!40000 ALTER TABLE `y5g_item_outgo_history` DISABLE KEYS */;
INSERT INTO `y5g_item_outgo_history` VALUES (2,2,'2019-07-06',1,'123231','','','','',3620.0000,'',5,2,1562402236,1562984473,0.0000,0),(3,2,'2019-07-13',1,'556556665566565656','','','','',2000.0000,'',5,2,1562984814,1566825345,0.0000,0),(4,6,'2019-08-19',1,'1234466','','','','',2399.0000,'',5,2,1566206909,1567341902,0.0000,0),(5,11,'2019-09-01',1,'454567467567','','','','',2681.0000,'',5,2,1567340540,1567655405,50.0000,0),(6,6,'2019-09-02',1,'555656465','阿瑟','','','',2565.0000,'我亲热万人沃尔沃人',3,2,1567409681,1567437859,36.0000,0),(7,14,'2019-09-02',1,'123456','','','','',2000.0000,'',4,2,1567429798,1568733613,200.0000,0),(8,6,'2019-09-05',1,'454545468465','','','','',1200.0000,'',4,2,1567655365,1570353706,20.0000,0),(9,9,'2019-09-05',0,'54545421','','','','',2560.0000,'',4,2,1567655380,1568733526,36.0000,0),(10,11,'2019-09-05',1,'201907011-x002','小111','','','',2099.0000,'',2,1,1567686982,1569038123,200.0000,0),(11,24,'2019-09-17',1,'ewrrrr','','','','',1200.0000,'',2,2,1568733507,1568733648,100.0000,0),(12,13,'2019-09-21',1,'61230838525957552','','','','',5555.0000,'',2,2,1569038116,1570262659,50.0000,0),(13,19,'2019-09-21',0,'612308385259','','','','',2100.0000,'',2,2,1569055592,1570353745,1.0000,0);
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

-- Dump completed on 2019-11-22 20:01:40
