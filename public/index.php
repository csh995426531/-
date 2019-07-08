<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// // 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

header("Content-type:text/html;charset=utf-8");
//配置信息
$cfg_dbhost = '172.21.0.1';
$cfg_dbname = 'maiguo';
$cfg_dbuser = 'root';
$cfg_dbpwd = '123456';
$cfg_db_language = 'utf8';
$to_file_name = "databases_backup.sql";
//END 配置
 
// 创建连接
$conn = new mysqli($cfg_dbhost, $cfg_dbuser, $cfg_dbpwd, $cfg_dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo 'success';die;

// // 使用 sql 创建数据表
$sql = "CREATE TABLE `y5g_item_network` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类别id',
    `name_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '名称id',
    `data` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1正常 2失效',
    `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
    `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
    PRIMARY KEY (`id`,`name_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

// if ($conn->query($sql)) {
//     echo "数据表 y5g_item_network 创建成功";
// } else {
//     echo "创建数据表错误: " .$conn->error;
// }

$sql = "INSERT INTO `maiguo`.`y5g_access_node` (`id`, `module`, `controller`, `action`, `name`, `parent_id`, `create_time`, `update_time`) VALUES ('30', 'index', 'setting', 'network', '网络模式录入', '19', '0', '0')";

// if ($conn->query($sql)) {
//     echo "数据表 y5g_access_node 更新成功";
// } else {
//     echo "数据表 y5g_access_node 更新错误: ".$conn->error;
// }

$sql = "ALTER TABLE y5g_item_type CHANGE feature_id network_id  int(10) unsigned NOT NULL DEFAULT '0' COMMENT '网络模式id'";

// if ($conn->query($sql)) {
//     echo "数据表 y5g_item_type 更新成功";
// } else {
//     echo "数据表 y5g_item_type 更新错误: " .$conn->error;
// }
// mysqli_close($conn);
// //数据库中有哪些表
// $tables = mysql_query("SHOW TABLES FROM $cfg_dbname");
// //将这些表记录到一个数组
// $tabList = array();
// while($row = mysql_fetch_row($tables)) {
//     $tabList[] = $row[0];
// }
// $sqldump = '';
// //echo "运行中，请耐心等待...<br/>";
// $info = "-- ----------------------------\r\n";
// $info .= "-- 日期：".date("Y-m-d H:i:s",time())."\r\n";
// $info .= "-- Power by 王永东博客(http://www.wangyongdong.com)\r\n";
// $info .= "-- 仅用于测试和学习,本程序不适合处理超大量数据\r\n";
// $info .= "-- ----------------------------\r\n\r\n";
// //file_put_contents($to_file_name,$info,FILE_APPEND);
// $sqldump .= $info;
 
// //将每个表的表结构导出到文件
// foreach($tabList as $val){
//     $sql = "show create table ".$val;
//     $res = mysql_query($sql,$link);
//     $row = mysql_fetch_array($res);
//     $info = "-- ----------------------------\r\n";
//     $info .= "-- Table structure for `".$val."`\r\n";
//     $info .= "-- ----------------------------\r\n";
//     $info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
//     $sqlStr = $info.$row[1].";\r\n\r\n";
//     //追加到文件
//     //file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
//     $sqldump .= $sqlStr;
//     //释放资源
//     mysql_free_result($res);
// }
 
// //将每个表的数据导出到文件
// foreach($tabList as $val){
//     $sql = "select * from ".$val;
//     $res = mysql_query($sql,$link);
//     //如果表中没有数据，则继续下一张表
//     if(mysql_num_rows($res)<1) continue;
//     //
//     $info = "-- ----------------------------\r\n";
//     $info .= "-- Records for `".$val."`\r\n";
//     $info .= "-- ----------------------------\r\n";
//     $sqldump .= $info;
//     //file_put_contents($to_file_name,$info,FILE_APPEND);
//     //读取数据
//     while($row = mysql_fetch_row($res)){
//         $sqlStr = "INSERT INTO `".$val."` VALUES (";
//         foreach($row as $zd){
//             $sqlStr .= "'".$zd."', ";
//         }
//         //去掉最后一个逗号和空格
//         $sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
//         $sqlStr .= ");\r\n";
//         $sqldump .= $sqlStr;
//         //file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
//     }
//     //释放资源
//     mysql_free_result($res);
//     $sqldump .= '\r\n';
//     //file_put_contents($to_file_name,"\r\n",FILE_APPEND);
// }
 
// $filename = 'ciblog_'. date('Ymd_His', time()).'.sql';
// header('Content-Type: text/x-sql');
// header("Content-Disposition:attachment;filename=".$filename);
 
// echo $sqldump;