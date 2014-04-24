/*
Navicat MySQL Data Transfer

Source Server         : Localhos(XAMPP)
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : possp_transactions

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-04-24 12:56:16
*/

-- CREATE TABLE IF NOT EXISTS `possp_transactions`; Crear Esta base de datos

SET FOREIGN_KEY_CHECKS=0;

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
-- Records of ospos_transfer_items
-- ----------------------------
