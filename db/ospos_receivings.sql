/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : possp

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-05-30 08:51:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ospos_receivings`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_receivings`;
CREATE TABLE `ospos_receivings` (
  `receiving_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supplier_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `receiving_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(20) DEFAULT NULL,
  `payment` double(15,0) DEFAULT NULL,
  PRIMARY KEY (`receiving_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_receivings
-- ----------------------------
INSERT INTO `ospos_receivings` VALUES ('2012-11-23 11:52:28', null, '6', '', '1', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2013-12-05 10:25:06', null, '1', 'All done', '2', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2013-12-05 10:30:07', null, '1', '', '3', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2013-12-05 10:35:50', null, '1', '', '4', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2013-12-06 10:22:46', null, '1', '', '5', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2013-12-13 14:22:18', null, '1', '', '6', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-13 10:40:59', null, '1', '', '7', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-13 10:51:20', null, '1', '', '8', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-13 11:18:24', null, '1', '', '9', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-15 15:03:41', null, '1', '', '10', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-15 15:06:26', null, '1', '', '11', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-15 15:07:16', null, '1', '', '12', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-17 14:22:50', null, '1', '', '13', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 08:59:07', null, '1', '', '14', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:02:03', null, '1', '', '15', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:02:34', null, '1', '', '16', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:04:58', null, '1', '', '17', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:08:02', null, '1', '', '18', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:12:48', null, '1', '', '19', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 13:23:46', null, '1', 'prueba de gustavo', '20', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 13:31:47', null, '1', '', '21', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:19:44', null, '1', '', '22', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:20:46', null, '1', '', '23', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:37:49', null, '1', '', '24', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:48:40', null, '1', '', '25', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:49:53', null, '1', '', '26', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:00:50', null, '1', '', '27', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:01:37', null, '1', '', '28', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:02:04', null, '1', '', '29', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:03:07', null, '1', '', '30', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:11:21', null, '1', '', '31', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:57:13', null, '1', '', '32', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 16:42:44', null, '1', '', '33', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 16:48:49', null, '1', '', '34', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:12:02', null, '1', '', '35', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:22:22', null, '1', '', '36', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:24:56', null, '1', '', '37', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:28:36', null, '1', '', '38', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:30:09', null, '1', '', '39', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-22 16:24:56', null, '1', '', '40', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-22 16:32:37', null, '1', '', '41', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-22 16:45:47', null, '1', '', '42', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-02-04 09:47:56', null, '1', 'jugjhjghjghjghjghjghj', '43', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-03-05 16:12:20', null, '1', '', '44', '0', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-03-28 10:33:11', '68', '1', '', '45', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-04-30 10:07:51', null, '1', '', '46', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-05-22 12:00:42', null, '1', '', '47', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-05-22 14:27:10', null, '1', '', '48', 'Cash', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-05-29 09:12:52', '92', '1', '', '49', 'Efectivo', '200');
