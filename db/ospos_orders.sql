/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : possp_centralized

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-06-25 15:03:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ospos_orders`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_orders`;
CREATE TABLE `ospos_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `comments` mediumtext,
  `location` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_orders_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_orders_items`;
CREATE TABLE `ospos_orders_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_item` int(10) DEFAULT NULL,
  `quantity` double(15,0) DEFAULT NULL,
  `id_order` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_orders_items
-- ----------------------------
