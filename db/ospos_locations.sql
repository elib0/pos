/*
Navicat MySQL Data Transfer

Source Server         : Localhos(XAMPP)
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : possp

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-04-30 16:16:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ospos_locations`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_locations`;
CREATE TABLE `ospos_locations` (
  `name` varchar(20) NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hostname` varchar(50) NOT NULL DEFAULT 'localhost',
  `username` varchar(20) NOT NULL DEFAULT 'root',
  `password` varchar(200) NOT NULL,
  `database` varchar(20) NOT NULL,
  `dbdriver` varchar(12) NOT NULL DEFAULT 'mysql',
  `dbprefix` varchar(10) NOT NULL DEFAULT 'ospos_',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_locations
-- ----------------------------
-- INSERT INTO `ospos_locations` VALUES ('otra', NULL, 'localhost', 'root', 'root', 'possp2', 'mysql', 'ospos_', '1');
