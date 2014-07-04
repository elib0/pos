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
  `name` varchar(50) NOT NULL,
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

-- ----------------------------
-- Table structure for `ospos_transfers`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_transfers`;
CREATE TABLE `ospos_transfers` (
  `transfer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `payment_type` varchar(512) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_transfers
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_transfer_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_transfer_items`;
CREATE TABLE `ospos_transfer_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) unsigned NOT NULL,
  `item_id` int(10) NOT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` double(15,2) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `quantity_purchased` double(15,0) NOT NULL DEFAULT '1',
  `line` int(3) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `ospos_orders`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_orders`;
CREATE TABLE `ospos_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `comments` mediumtext,
  `location` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ospos_order_items`;
CREATE TABLE `ospos_order_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_item` int(10) DEFAULT NULL,
  `current_quantity` double(15,0) DEFAULT NULL,
  `quantity` double(15,0) DEFAULT NULL,
  `id_order` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_orders_items
-- ----------------------------
