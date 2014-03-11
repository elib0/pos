/*
Navicat MySQL Data Transfer

Source Server         : Localhos(XAMPP)
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : possp

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-03-11 16:38:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cometchat`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat`;
CREATE TABLE `cometchat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_announcements`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_announcements`;
CREATE TABLE `cometchat_announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `announcement` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `to` int(10) NOT NULL,
  `integer` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `time` (`time`),
  KEY `to_id` (`to`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_announcements
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_apehistory`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_apehistory`;
CREATE TABLE `cometchat_apehistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `channel` (`channel`),
  KEY `sent` (`sent`),
  KEY `channel_sent` (`channel`,`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_apehistory
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_block`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_block`;
CREATE TABLE `cometchat_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromid_toid` (`fromid`,`toid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_block
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_chatroommessages`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_chatroommessages`;
CREATE TABLE `cometchat_chatroommessages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `chatroomid` (`chatroomid`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_chatroommessages
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_chatrooms`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_chatrooms`;
CREATE TABLE `cometchat_chatrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `createdby` int(10) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `vidsession` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`),
  KEY `createdby` (`createdby`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_chatrooms
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_chatrooms_users`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_chatrooms_users`;
CREATE TABLE `cometchat_chatrooms_users` (
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`userid`,`chatroomid`) USING BTREE,
  KEY `chatroomid` (`chatroomid`),
  KEY `lastactivity` (`lastactivity`),
  KEY `userid` (`userid`),
  KEY `userid_chatroomid` (`chatroomid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_chatrooms_users
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_guests`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_guests`;
CREATE TABLE `cometchat_guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cometchat_guests
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_messages_old`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_messages_old`;
CREATE TABLE `cometchat_messages_old` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_messages_old
-- ----------------------------

-- ----------------------------
-- Table structure for `cometchat_status`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_status`;
CREATE TABLE `cometchat_status` (
  `userid` int(10) unsigned NOT NULL,
  `message` text,
  `status` enum('available','away','busy','invisible','offline') DEFAULT NULL,
  `typingto` int(10) unsigned DEFAULT NULL,
  `typingtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `typingto` (`typingto`),
  KEY `typingtime` (`typingtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_status
-- ----------------------------
INSERT INTO `cometchat_status` VALUES ('1', null, 'away', null, null);
INSERT INTO `cometchat_status` VALUES ('7', null, 'away', null, null);

-- ----------------------------
-- Table structure for `cometchat_videochatsessions`
-- ----------------------------
DROP TABLE IF EXISTS `cometchat_videochatsessions`;
CREATE TABLE `cometchat_videochatsessions` (
  `username` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `timestamp` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`username`),
  KEY `username` (`username`),
  KEY `identity` (`identity`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cometchat_videochatsessions
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_app_config`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_app_config`;
CREATE TABLE `ospos_app_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_app_config
-- ----------------------------
INSERT INTO `ospos_app_config` VALUES ('address', '3923 N McArthur\nWarr Acres\nOK 73122');
INSERT INTO `ospos_app_config` VALUES ('company', 'Fast I Repair');
INSERT INTO `ospos_app_config` VALUES ('default_tax_rate', '8');
INSERT INTO `ospos_app_config` VALUES ('email', 'info@smokefreevapor.net');
INSERT INTO `ospos_app_config` VALUES ('fax', '');
INSERT INTO `ospos_app_config` VALUES ('phone', '405-603-3599');
INSERT INTO `ospos_app_config` VALUES ('return_policy', 'All Sales Final\n');
INSERT INTO `ospos_app_config` VALUES ('timezone', 'America/Chicago');
INSERT INTO `ospos_app_config` VALUES ('website', 'www.smokefreevapor.net');
INSERT INTO `ospos_app_config` VALUES ('default_tax_1_rate', '8.365');
INSERT INTO `ospos_app_config` VALUES ('default_tax_1_name', 'Sales Tax');
INSERT INTO `ospos_app_config` VALUES ('default_tax_2_rate', '2');
INSERT INTO `ospos_app_config` VALUES ('default_tax_2_name', 'TAxes bads');
INSERT INTO `ospos_app_config` VALUES ('currency_symbol', '$');
INSERT INTO `ospos_app_config` VALUES ('language', 'english');
INSERT INTO `ospos_app_config` VALUES ('print_after_sale', 'print_after_sale');

-- ----------------------------
-- Table structure for `ospos_customers`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_customers`;
CREATE TABLE `ospos_customers` (
  `person_id` int(10) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `taxable` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `account_number` (`account_number`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_customers
-- ----------------------------
INSERT INTO `ospos_customers` VALUES ('2', null, '0', '0');
INSERT INTO `ospos_customers` VALUES ('3', null, '1', '0');

-- ----------------------------
-- Table structure for `ospos_employees`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_employees`;
CREATE TABLE `ospos_employees` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `id_schedule` int(1) DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `lastChatActivity` int(2) NOT NULL,
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_employees
-- ----------------------------
INSERT INTO `ospos_employees` VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', '1', '1', '0', '0');
INSERT INTO `ospos_employees` VALUES ('speed', '21232f297a57a5a743894a0e4a801fc3', '4', '1', '0', '0');

-- ----------------------------
-- Table structure for `ospos_employees_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_employees_schedule`;
CREATE TABLE `ospos_employees_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `login` time NOT NULL,
  `logout` time DEFAULT NULL,
  `location` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_employees_schedule
-- ----------------------------
INSERT INTO `ospos_employees_schedule` VALUES ('1', '1', '2014-02-01', '08:00:00', '16:31:31', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('2', '1', '2014-02-02', '08:20:00', '09:31:31', 'other');
INSERT INTO `ospos_employees_schedule` VALUES ('3', '1', '2014-02-03', '08:15:50', '19:31:31', 'other');
INSERT INTO `ospos_employees_schedule` VALUES ('4', '1', '2014-02-04', '08:19:20', '13:31:31', 'other');
INSERT INTO `ospos_employees_schedule` VALUES ('5', '1', '2014-02-05', '08:00:00', '23:59:59', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('6', '1', '2014-02-06', '08:00:00', '13:00:31', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('8', '1', '2014-02-08', '09:13:13', '13:00:31', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('9', '1', '2014-02-09', '13:31:23', '14:50:00', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('180', '1', '2014-03-05', '09:50:30', '09:50:52', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('181', '1', '2014-03-05', '09:51:00', '09:51:19', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('182', '1', '2014-03-05', '09:51:08', '09:51:19', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('183', '1', '2014-03-05', '10:01:31', '10:03:45', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('184', '1', '2014-03-05', '10:03:49', '10:10:23', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('185', '1', '2014-03-05', '10:10:28', '12:16:41', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('186', '4', '2014-03-05', '10:10:39', '12:16:43', 'default');

-- ----------------------------
-- Table structure for `ospos_giftcards`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_giftcards`;
CREATE TABLE `ospos_giftcards` (
  `giftcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `giftcard_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `value` double(15,2) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`giftcard_id`),
  UNIQUE KEY `giftcard_number` (`giftcard_number`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ospos_giftcards
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_inventory`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_inventory`;
CREATE TABLE `ospos_inventory` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_items` int(11) NOT NULL DEFAULT '0',
  `trans_user` int(11) NOT NULL DEFAULT '0',
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_comment` text NOT NULL,
  `trans_inventory` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trans_id`),
  KEY `ospos_inventory_ibfk_1` (`trans_items`),
  KEY `ospos_inventory_ibfk_2` (`trans_user`)
) ENGINE=MyISAM AUTO_INCREMENT=475 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_inventory
-- ----------------------------
INSERT INTO `ospos_inventory` VALUES ('1', '1', '1', '2012-11-02 11:30:24', 'Manual Edit of Quantity', '80');
INSERT INTO `ospos_inventory` VALUES ('2', '1', '1', '2012-11-02 10:35:01', 'POS 1', '-1');
INSERT INTO `ospos_inventory` VALUES ('3', '1', '1', '2012-11-02 14:17:58', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('4', '2', '1', '2012-11-02 14:19:45', 'Manual Edit of Quantity', '30');
INSERT INTO `ospos_inventory` VALUES ('5', '3', '1', '2012-11-02 14:20:56', 'Manual Edit of Quantity', '1000');
INSERT INTO `ospos_inventory` VALUES ('6', '1', '1', '2012-11-02 14:23:57', 'POS 2', '-1');
INSERT INTO `ospos_inventory` VALUES ('7', '2', '1', '2012-11-02 14:23:57', 'POS 2', '-1');
INSERT INTO `ospos_inventory` VALUES ('8', '3', '1', '2012-11-02 14:23:57', 'POS 2', '-1');
INSERT INTO `ospos_inventory` VALUES ('9', '4', '1', '2012-11-03 08:22:20', 'Manual Edit of Quantity', '8');
INSERT INTO `ospos_inventory` VALUES ('10', '4', '1', '2012-11-03 08:23:46', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('11', '5', '1', '2012-11-03 08:24:41', 'Manual Edit of Quantity', '42');
INSERT INTO `ospos_inventory` VALUES ('12', '4', '1', '2012-11-03 08:25:15', 'POS 3', '-1');
INSERT INTO `ospos_inventory` VALUES ('13', '5', '1', '2012-11-03 08:25:15', 'POS 3', '-1');
INSERT INTO `ospos_inventory` VALUES ('14', '6', '1', '2012-11-03 08:31:52', 'Manual Edit of Quantity', '11');
INSERT INTO `ospos_inventory` VALUES ('15', '4', '1', '2012-11-03 08:32:28', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('16', '7', '1', '2012-11-03 08:41:11', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('17', '8', '1', '2012-11-03 08:42:17', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('18', '9', '1', '2012-11-03 08:43:33', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('19', '10', '1', '2012-11-03 08:44:34', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('20', '11', '1', '2012-11-03 08:45:44', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('21', '12', '1', '2012-11-03 08:48:50', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('22', '13', '1', '2012-11-03 08:49:37', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('23', '14', '1', '2012-11-03 08:52:10', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('24', '14', '1', '2012-11-03 08:52:41', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('25', '15', '1', '2012-11-03 08:53:51', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('26', '16', '1', '2012-11-03 08:54:43', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('27', '9', '1', '2012-11-03 08:55:13', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('28', '17', '1', '2012-11-03 08:56:26', 'Manual Edit of Quantity', '9');
INSERT INTO `ospos_inventory` VALUES ('29', '18', '1', '2012-11-03 08:59:37', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('30', '19', '1', '2012-11-03 09:00:29', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('31', '20', '1', '2012-11-03 09:01:57', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('32', '21', '1', '2012-11-03 09:02:46', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('33', '22', '1', '2012-11-03 09:04:50', 'Manual Edit of Quantity', '7');
INSERT INTO `ospos_inventory` VALUES ('34', '23', '1', '2012-11-03 09:05:25', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('35', '24', '1', '2012-11-03 09:08:16', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('36', '25', '1', '2012-11-03 09:12:05', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('37', '26', '1', '2012-11-03 09:13:17', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('38', '25', '1', '2012-11-03 09:13:35', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('39', '27', '1', '2012-11-03 09:14:37', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('40', '28', '1', '2012-11-03 09:15:33', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('41', '29', '1', '2012-11-03 09:21:30', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('42', '30', '1', '2012-11-03 09:22:05', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('43', '31', '1', '2012-11-03 09:22:55', 'Manual Edit of Quantity', '7');
INSERT INTO `ospos_inventory` VALUES ('44', '32', '1', '2012-11-03 09:24:57', 'Manual Edit of Quantity', '6');
INSERT INTO `ospos_inventory` VALUES ('45', '33', '3', '2012-11-03 09:27:44', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('46', '34', '3', '2012-11-03 09:29:28', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('47', '35', '3', '2012-11-03 09:29:33', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('48', '29', '3', '2012-11-03 14:09:25', 'POS 4', '-1');
INSERT INTO `ospos_inventory` VALUES ('49', '5', '3', '2012-11-03 14:54:52', 'POS 5', '-1');
INSERT INTO `ospos_inventory` VALUES ('50', '20', '1', '2012-11-04 09:59:12', 'POS 6', '-1');
INSERT INTO `ospos_inventory` VALUES ('51', '23', '1', '2012-11-04 13:10:51', 'POS 7', '-1');
INSERT INTO `ospos_inventory` VALUES ('52', '36', '1', '2012-11-04 13:12:33', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('53', '36', '1', '2012-11-04 13:18:20', 'POS 8', '-1');
INSERT INTO `ospos_inventory` VALUES ('54', '5', '1', '2012-11-04 13:18:20', 'POS 8', '-1');
INSERT INTO `ospos_inventory` VALUES ('55', '4', '1', '2012-11-04 13:27:06', 'POS 9', '-1');
INSERT INTO `ospos_inventory` VALUES ('56', '5', '1', '2012-11-04 13:27:06', 'POS 9', '-1');
INSERT INTO `ospos_inventory` VALUES ('57', '36', '1', '2012-11-05 07:01:02', 'POS 10', '-1');
INSERT INTO `ospos_inventory` VALUES ('58', '36', '1', '2012-11-05 07:56:45', 'POS 11', '-1');
INSERT INTO `ospos_inventory` VALUES ('59', '36', '1', '2012-11-05 13:44:19', 'POS 12', '-1');
INSERT INTO `ospos_inventory` VALUES ('60', '5', '1', '2012-11-05 13:44:19', 'POS 12', '-1');
INSERT INTO `ospos_inventory` VALUES ('61', '36', '1', '2012-11-06 05:45:57', 'POS 13', '-1');
INSERT INTO `ospos_inventory` VALUES ('62', '36', '1', '2012-11-06 07:22:11', 'POS 14', '-1');
INSERT INTO `ospos_inventory` VALUES ('63', '37', '1', '2012-11-06 09:16:49', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('64', '38', '1', '2012-11-06 09:17:35', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('65', '39', '1', '2012-11-06 09:18:07', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('66', '40', '1', '2012-11-06 09:18:39', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('67', '41', '1', '2012-11-06 09:20:29', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('68', '42', '1', '2012-11-06 09:20:46', 'Manual Edit of Quantity', '6');
INSERT INTO `ospos_inventory` VALUES ('69', '43', '1', '2012-11-06 09:21:24', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('70', '44', '1', '2012-11-06 09:21:39', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('71', '45', '1', '2012-11-06 09:22:11', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('72', '46', '1', '2012-11-06 09:23:00', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('73', '47', '1', '2012-11-06 09:24:05', 'Manual Edit of Quantity', '9');
INSERT INTO `ospos_inventory` VALUES ('74', '48', '1', '2012-11-06 09:24:31', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('75', '49', '1', '2012-11-06 09:25:13', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('76', '50', '1', '2012-11-06 09:25:37', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('77', '51', '1', '2012-11-06 09:26:10', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('78', '52', '1', '2012-11-06 09:26:38', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('79', '53', '1', '2012-11-06 09:27:14', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('80', '54', '1', '2012-11-06 09:28:13', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('81', '55', '1', '2012-11-06 09:28:42', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('82', '56', '1', '2012-11-06 09:29:34', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('83', '57', '1', '2012-11-06 09:29:58', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('84', '58', '1', '2012-11-06 09:30:44', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('85', '59', '1', '2012-11-06 09:33:25', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('86', '60', '1', '2012-11-06 09:34:00', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('87', '61', '1', '2012-11-06 09:35:21', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('88', '62', '1', '2012-11-06 09:36:29', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('89', '63', '1', '2012-11-06 09:38:03', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('90', '64', '1', '2012-11-06 09:38:36', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('91', '65', '1', '2012-11-06 09:39:15', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('92', '66', '1', '2012-11-06 09:39:45', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('93', '67', '1', '2012-11-06 09:40:08', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('94', '68', '1', '2012-11-06 09:40:30', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('95', '69', '1', '2012-11-06 09:40:52', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('96', '70', '1', '2012-11-06 09:41:21', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('97', '71', '1', '2012-11-06 09:42:04', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('98', '72', '1', '2012-11-06 09:42:43', 'Manual Edit of Quantity', '2');
INSERT INTO `ospos_inventory` VALUES ('99', '73', '1', '2012-11-06 09:49:26', 'Manual Edit of Quantity', '6');
INSERT INTO `ospos_inventory` VALUES ('100', '74', '1', '2012-11-06 09:50:07', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('101', '75', '1', '2012-11-06 09:51:23', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('102', '76', '1', '2012-11-06 09:52:24', 'Manual Edit of Quantity', '11');
INSERT INTO `ospos_inventory` VALUES ('103', '77', '1', '2012-11-06 09:52:55', 'Manual Edit of Quantity', '5');
INSERT INTO `ospos_inventory` VALUES ('104', '78', '1', '2012-11-06 09:53:29', 'Manual Edit of Quantity', '8');
INSERT INTO `ospos_inventory` VALUES ('105', '79', '1', '2012-11-06 09:54:30', 'Manual Edit of Quantity', '36');
INSERT INTO `ospos_inventory` VALUES ('106', '80', '1', '2012-11-06 09:55:14', 'Manual Edit of Quantity', '6');
INSERT INTO `ospos_inventory` VALUES ('107', '81', '1', '2012-11-06 09:55:50', 'Manual Edit of Quantity', '6');
INSERT INTO `ospos_inventory` VALUES ('108', '82', '1', '2012-11-06 09:56:26', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('109', '83', '1', '2012-11-06 09:56:51', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('110', '84', '1', '2012-11-06 09:57:31', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('111', '85', '1', '2012-11-06 09:57:48', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('112', '86', '1', '2012-11-06 10:01:03', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('113', '87', '1', '2012-11-06 10:01:25', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('114', '78', '1', '2012-11-06 11:12:41', 'POS 15', '-1');
INSERT INTO `ospos_inventory` VALUES ('115', '49', '1', '2012-11-06 13:36:11', 'POS 16', '-1');
INSERT INTO `ospos_inventory` VALUES ('116', '66', '1', '2012-11-06 13:36:11', 'POS 16', '-1');
INSERT INTO `ospos_inventory` VALUES ('117', '88', '1', '2012-11-06 14:31:52', 'Manual Edit of Quantity', '100');
INSERT INTO `ospos_inventory` VALUES ('118', '89', '1', '2012-11-06 14:32:13', 'Manual Edit of Quantity', '100');
INSERT INTO `ospos_inventory` VALUES ('119', '88', '1', '2012-11-06 14:35:34', 'POS 17', '-1');
INSERT INTO `ospos_inventory` VALUES ('120', '78', '1', '2012-11-06 14:49:08', 'POS 18', '-1');
INSERT INTO `ospos_inventory` VALUES ('121', '89', '1', '2012-11-06 15:16:18', 'POS 19', '-1');
INSERT INTO `ospos_inventory` VALUES ('122', '89', '6', '2012-11-06 15:28:43', 'POS 20', '-1');
INSERT INTO `ospos_inventory` VALUES ('123', '61', '6', '2012-11-06 15:39:38', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('124', '58', '6', '2012-11-06 15:40:25', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('125', '88', '6', '2012-11-06 15:44:59', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('126', '90', '6', '2012-11-06 15:46:54', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('127', '55', '5', '2012-11-07 13:58:28', 'POS 21', '-1');
INSERT INTO `ospos_inventory` VALUES ('128', '89', '5', '2012-11-07 14:02:05', 'POS 22', '-1');
INSERT INTO `ospos_inventory` VALUES ('129', '89', '5', '2012-11-07 14:02:51', 'POS 23', '-1');
INSERT INTO `ospos_inventory` VALUES ('130', '89', '6', '2012-11-07 14:21:21', 'POS 24', '-1');
INSERT INTO `ospos_inventory` VALUES ('131', '89', '5', '2012-11-07 14:21:22', 'POS 25', '-1');
INSERT INTO `ospos_inventory` VALUES ('132', '89', '6', '2012-11-08 12:00:07', 'POS 26', '-2');
INSERT INTO `ospos_inventory` VALUES ('133', '89', '6', '2012-11-08 12:11:46', 'POS 27', '-1');
INSERT INTO `ospos_inventory` VALUES ('134', '80', '5', '2012-11-08 13:39:32', 'POS 28', '-1');
INSERT INTO `ospos_inventory` VALUES ('135', '80', '5', '2012-11-08 13:42:25', 'POS 29', '-1');
INSERT INTO `ospos_inventory` VALUES ('136', '81', '5', '2012-11-08 13:42:25', 'POS 29', '-1');
INSERT INTO `ospos_inventory` VALUES ('137', '69', '5', '2012-11-08 16:15:48', 'POS 30', '-1');
INSERT INTO `ospos_inventory` VALUES ('138', '89', '6', '2012-11-09 06:39:42', 'POS 31', '-1');
INSERT INTO `ospos_inventory` VALUES ('139', '47', '6', '2012-11-09 11:53:34', 'POS 32', '-1');
INSERT INTO `ospos_inventory` VALUES ('140', '89', '6', '2012-11-09 11:54:17', 'POS 33', '-1');
INSERT INTO `ospos_inventory` VALUES ('141', '86', '5', '2012-11-09 14:28:38', 'POS 34', '-1');
INSERT INTO `ospos_inventory` VALUES ('142', '50', '5', '2012-11-09 16:14:47', 'POS 35', '-1');
INSERT INTO `ospos_inventory` VALUES ('143', '42', '6', '2012-11-10 11:19:10', 'POS 36', '-1');
INSERT INTO `ospos_inventory` VALUES ('144', '89', '6', '2012-11-10 12:57:02', 'POS 37', '-1');
INSERT INTO `ospos_inventory` VALUES ('145', '89', '6', '2012-11-10 15:34:52', 'POS 38', '-1');
INSERT INTO `ospos_inventory` VALUES ('146', '89', '6', '2012-11-10 16:09:36', 'POS 39', '-1');
INSERT INTO `ospos_inventory` VALUES ('147', '89', '6', '2012-11-10 16:10:08', 'POS 40', '-1');
INSERT INTO `ospos_inventory` VALUES ('148', '89', '6', '2012-11-11 06:07:46', 'POS 41', '-1');
INSERT INTO `ospos_inventory` VALUES ('149', '89', '6', '2012-11-11 09:10:46', 'POS 42', '-1');
INSERT INTO `ospos_inventory` VALUES ('150', '89', '6', '2012-11-11 09:11:58', 'POS 43', '-1');
INSERT INTO `ospos_inventory` VALUES ('151', '79', '6', '2012-11-11 11:57:11', 'POS 44', '-1');
INSERT INTO `ospos_inventory` VALUES ('152', '89', '6', '2012-11-11 13:12:56', 'POS 45', '-1');
INSERT INTO `ospos_inventory` VALUES ('153', '89', '6', '2012-11-11 13:14:54', 'POS 46', '-1');
INSERT INTO `ospos_inventory` VALUES ('154', '89', '6', '2012-11-11 15:02:03', 'POS 47', '-1');
INSERT INTO `ospos_inventory` VALUES ('155', '48', '6', '2012-11-12 10:47:15', 'POS 48', '-1');
INSERT INTO `ospos_inventory` VALUES ('156', '43', '6', '2012-11-12 10:49:14', 'POS 49', '-1');
INSERT INTO `ospos_inventory` VALUES ('157', '89', '6', '2012-11-12 10:53:04', 'POS 50', '-1');
INSERT INTO `ospos_inventory` VALUES ('158', '53', '6', '2012-11-12 11:19:36', 'Manual Edit of Quantity', '-1');
INSERT INTO `ospos_inventory` VALUES ('159', '64', '6', '2012-11-12 11:20:42', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('160', '89', '6', '2012-11-12 12:20:13', 'POS 51', '-1');
INSERT INTO `ospos_inventory` VALUES ('161', '89', '6', '2012-11-12 12:23:48', 'POS 52', '-1');
INSERT INTO `ospos_inventory` VALUES ('162', '89', '5', '2012-11-12 16:28:34', 'POS 53', '-1');
INSERT INTO `ospos_inventory` VALUES ('163', '41', '6', '2012-11-13 07:50:59', 'POS 54', '-1');
INSERT INTO `ospos_inventory` VALUES ('164', '89', '6', '2012-11-13 13:14:19', 'POS 55', '-1');
INSERT INTO `ospos_inventory` VALUES ('165', '61', '5', '2012-11-13 16:11:30', 'POS 56', '-1');
INSERT INTO `ospos_inventory` VALUES ('166', '89', '6', '2012-11-14 08:28:53', 'POS 57', '-1');
INSERT INTO `ospos_inventory` VALUES ('167', '89', '6', '2012-11-14 09:07:16', 'POS 58', '-1');
INSERT INTO `ospos_inventory` VALUES ('168', '61', '5', '2012-11-14 16:18:43', 'POS 59', '-1');
INSERT INTO `ospos_inventory` VALUES ('169', '50', '5', '2012-11-14 16:22:51', 'POS 60', '-1');
INSERT INTO `ospos_inventory` VALUES ('170', '37', '5', '2012-11-15 16:19:40', 'POS 61', '-1');
INSERT INTO `ospos_inventory` VALUES ('171', '91', '1', '2012-11-16 09:28:53', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('172', '92', '1', '2012-11-16 09:29:19', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('173', '45', '5', '2012-11-16 12:40:17', 'POS 62', '-1');
INSERT INTO `ospos_inventory` VALUES ('174', '37', '5', '2012-11-16 15:02:01', 'POS 63', '-1');
INSERT INTO `ospos_inventory` VALUES ('175', '45', '5', '2012-11-16 16:09:55', 'POS 64', '-1');
INSERT INTO `ospos_inventory` VALUES ('176', '89', '6', '2012-11-17 10:58:36', 'POS 65', '-1');
INSERT INTO `ospos_inventory` VALUES ('177', '80', '6', '2012-11-17 14:25:13', 'POS 66', '-1');
INSERT INTO `ospos_inventory` VALUES ('178', '39', '5', '2012-11-20 14:41:13', 'POS 67', '-1');
INSERT INTO `ospos_inventory` VALUES ('179', '84', '5', '2012-11-20 16:54:07', 'POS 68', '-1');
INSERT INTO `ospos_inventory` VALUES ('180', '85', '5', '2012-11-20 16:54:07', 'POS 68', '-1');
INSERT INTO `ospos_inventory` VALUES ('181', '89', '5', '2012-11-20 16:59:48', 'POS 69', '-1');
INSERT INTO `ospos_inventory` VALUES ('182', '73', '1', '2012-11-21 10:14:37', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('183', '73', '1', '2012-11-21 10:15:24', '', '-1');
INSERT INTO `ospos_inventory` VALUES ('184', '93', '6', '2012-11-23 05:52:07', 'Manual Edit of Quantity', '1');
INSERT INTO `ospos_inventory` VALUES ('185', '93', '6', '2012-11-23 05:52:28', 'RECV 1', '1');
INSERT INTO `ospos_inventory` VALUES ('186', '41', '6', '2012-11-23 07:51:00', 'POS 70', '-1');
INSERT INTO `ospos_inventory` VALUES ('187', '78', '6', '2012-11-23 07:51:00', 'POS 70', '-1');
INSERT INTO `ospos_inventory` VALUES ('188', '78', '6', '2012-11-23 08:12:39', 'POS 71', '-1');
INSERT INTO `ospos_inventory` VALUES ('189', '94', '6', '2012-11-23 08:35:17', 'Manual Edit of Quantity', '3');
INSERT INTO `ospos_inventory` VALUES ('190', '94', '6', '2012-11-23 08:38:23', 'POS 72', '-1');
INSERT INTO `ospos_inventory` VALUES ('191', '95', '6', '2012-11-23 08:40:14', 'Manual Edit of Quantity', '15');
INSERT INTO `ospos_inventory` VALUES ('192', '95', '6', '2012-11-23 08:43:17', 'POS 73', '-1');
INSERT INTO `ospos_inventory` VALUES ('193', '76', '6', '2012-11-23 10:36:30', 'POS 74', '-2');
INSERT INTO `ospos_inventory` VALUES ('194', '76', '6', '2012-11-23 10:37:33', 'POS 75', '-1');
INSERT INTO `ospos_inventory` VALUES ('195', '48', '6', '2012-11-23 11:48:08', 'POS 76', '-1');
INSERT INTO `ospos_inventory` VALUES ('196', '78', '6', '2012-11-23 12:08:43', 'POS 77', '-1');
INSERT INTO `ospos_inventory` VALUES ('197', '37', '1', '2012-11-23 13:40:24', 'POS 78', '-1');
INSERT INTO `ospos_inventory` VALUES ('198', '89', '1', '2012-11-23 16:13:19', 'POS 79', '-1');
INSERT INTO `ospos_inventory` VALUES ('199', '89', '1', '2012-11-23 16:24:22', 'POS 80', '-1');
INSERT INTO `ospos_inventory` VALUES ('200', '89', '1', '2012-11-24 06:48:38', 'POS 81', '-1');
INSERT INTO `ospos_inventory` VALUES ('201', '79', '1', '2012-11-24 07:11:23', 'POS 82', '-1');
INSERT INTO `ospos_inventory` VALUES ('202', '95', '1', '2012-11-24 07:11:23', 'POS 82', '-1');
INSERT INTO `ospos_inventory` VALUES ('203', '78', '1', '2012-11-24 07:53:46', 'POS 83', '-1');
INSERT INTO `ospos_inventory` VALUES ('204', '47', '6', '2012-11-24 10:08:22', 'POS 84', '-1');
INSERT INTO `ospos_inventory` VALUES ('205', '45', '6', '2012-11-24 10:28:30', 'POS 85', '-1');
INSERT INTO `ospos_inventory` VALUES ('206', '89', '6', '2012-11-24 11:57:06', 'POS 86', '-1');
INSERT INTO `ospos_inventory` VALUES ('207', '42', '6', '2012-11-24 11:58:17', 'POS 87', '-1');
INSERT INTO `ospos_inventory` VALUES ('208', '42', '6', '2012-11-24 12:31:32', 'POS 88', '-1');
INSERT INTO `ospos_inventory` VALUES ('209', '76', '6', '2012-11-24 12:31:32', 'POS 88', '-1');
INSERT INTO `ospos_inventory` VALUES ('210', '77', '6', '2012-11-24 12:37:13', 'POS 89', '-1');
INSERT INTO `ospos_inventory` VALUES ('211', '89', '6', '2012-11-24 12:37:13', 'POS 89', '-1');
INSERT INTO `ospos_inventory` VALUES ('212', '89', '6', '2012-11-24 12:56:48', 'POS 90', '-1');
INSERT INTO `ospos_inventory` VALUES ('213', '76', '6', '2012-11-24 14:16:35', 'POS 91', '-1');
INSERT INTO `ospos_inventory` VALUES ('214', '39', '6', '2012-11-24 14:16:35', 'POS 91', '-1');
INSERT INTO `ospos_inventory` VALUES ('215', '79', '6', '2012-11-24 15:20:13', 'POS 92', '-1');
INSERT INTO `ospos_inventory` VALUES ('216', '89', '6', '2012-11-24 16:26:40', 'POS 93', '-1');
INSERT INTO `ospos_inventory` VALUES ('217', '45', '1', '2013-02-25 09:14:22', 'POS 94', '-1');
INSERT INTO `ospos_inventory` VALUES ('218', '69', '1', '2013-02-25 09:14:22', 'POS 94', '-1');
INSERT INTO `ospos_inventory` VALUES ('219', '43', '1', '2013-02-25 09:16:21', 'POS 95', '-1');
INSERT INTO `ospos_inventory` VALUES ('220', '65', '1', '2013-02-25 09:16:21', 'POS 95', '-1');
INSERT INTO `ospos_inventory` VALUES ('221', '45', '1', '2013-04-24 09:34:07', 'Manual Edit of Quantity', '7');
INSERT INTO `ospos_inventory` VALUES ('222', '50', '1', '2013-04-29 03:52:45', 'POS 96', '-1');
INSERT INTO `ospos_inventory` VALUES ('223', '69', '1', '2013-04-29 03:52:45', 'POS 96', '-4');
INSERT INTO `ospos_inventory` VALUES ('224', '46', '1', '2013-04-29 03:52:45', 'POS 96', '-1');
INSERT INTO `ospos_inventory` VALUES ('225', '45', '9', '2013-04-29 05:10:07', 'POS 97', '-8');
INSERT INTO `ospos_inventory` VALUES ('226', '65', '9', '2013-04-29 05:10:07', 'POS 97', '-1');
INSERT INTO `ospos_inventory` VALUES ('227', '44', '9', '2013-04-29 05:10:07', 'POS 97', '-1');
INSERT INTO `ospos_inventory` VALUES ('228', '93', '9', '2013-04-29 09:32:30', 'POS 98', '-2');
INSERT INTO `ospos_inventory` VALUES ('229', '65', '9', '2013-04-29 09:32:30', 'POS 98', '-1');
INSERT INTO `ospos_inventory` VALUES ('230', '68', '9', '2013-04-29 09:32:30', 'POS 98', '-2');
INSERT INTO `ospos_inventory` VALUES ('231', '88', '1', '2013-04-29 09:48:30', 'POS 99', '-9');
INSERT INTO `ospos_inventory` VALUES ('232', '45', '1', '2013-04-30 04:23:02', 'Manual Edit of Quantity', '800');
INSERT INTO `ospos_inventory` VALUES ('233', '96', '1', '2013-04-30 06:14:01', 'Manual Edit of Quantity', '99');
INSERT INTO `ospos_inventory` VALUES ('234', '45', '9', '2013-04-30 10:48:12', 'POS 100', '-200');
INSERT INTO `ospos_inventory` VALUES ('235', '69', '9', '2013-04-30 10:48:53', 'POS 101', '-1');
INSERT INTO `ospos_inventory` VALUES ('236', '68', '9', '2013-04-30 10:48:53', 'POS 101', '-1');
INSERT INTO `ospos_inventory` VALUES ('237', '45', '1', '2013-05-06 04:27:44', 'Manual Edit of Quantity', '50');
INSERT INTO `ospos_inventory` VALUES ('238', '69', '1', '2013-05-06 04:27:57', 'Manual Edit of Quantity', '11');
INSERT INTO `ospos_inventory` VALUES ('239', '50', '1', '2013-05-06 04:28:05', 'Manual Edit of Quantity', '4');
INSERT INTO `ospos_inventory` VALUES ('240', '68', '1', '2013-05-06 04:28:13', 'Manual Edit of Quantity', '11');
INSERT INTO `ospos_inventory` VALUES ('241', '45', '1', '2013-05-07 10:48:04', '', '200');
INSERT INTO `ospos_inventory` VALUES ('242', '45', '1', '2013-05-08 05:30:06', '', '-60');
INSERT INTO `ospos_inventory` VALUES ('243', '69', '1', '2013-05-08 06:25:43', 'more more', '200');
INSERT INTO `ospos_inventory` VALUES ('244', '45', '1', '2013-05-09 04:53:54', '', '90');
INSERT INTO `ospos_inventory` VALUES ('245', '45', '1', '2013-05-09 04:54:15', '', '80');
INSERT INTO `ospos_inventory` VALUES ('246', '45', '1', '2013-05-09 05:00:01', '', '60');
INSERT INTO `ospos_inventory` VALUES ('247', '69', '1', '2013-05-09 05:01:26', '', '6');
INSERT INTO `ospos_inventory` VALUES ('248', '69', '1', '2013-05-09 05:01:27', '', '6');
INSERT INTO `ospos_inventory` VALUES ('249', '45', '1', '2013-05-09 05:01:40', '', '65');
INSERT INTO `ospos_inventory` VALUES ('250', '45', '1', '2013-05-09 05:01:41', '', '65');
INSERT INTO `ospos_inventory` VALUES ('251', '45', '1', '2013-05-09 05:03:12', '', '23');
INSERT INTO `ospos_inventory` VALUES ('252', '45', '1', '2013-05-09 05:03:36', '', '90');
INSERT INTO `ospos_inventory` VALUES ('253', '45', '1', '2013-05-09 05:03:40', '', '90');
INSERT INTO `ospos_inventory` VALUES ('254', '45', '1', '2013-05-09 05:04:38', '', '3');
INSERT INTO `ospos_inventory` VALUES ('255', '45', '1', '2013-05-09 05:04:43', '', '60');
INSERT INTO `ospos_inventory` VALUES ('256', '45', '1', '2013-05-09 05:05:37', '', '200');
INSERT INTO `ospos_inventory` VALUES ('257', '45', '1', '2013-05-09 05:34:21', '', '1000');
INSERT INTO `ospos_inventory` VALUES ('258', '45', '1', '2013-05-09 05:37:26', '', '20');
INSERT INTO `ospos_inventory` VALUES ('259', '45', '1', '2013-05-09 05:47:39', '', '40');
INSERT INTO `ospos_inventory` VALUES ('260', '45', '1', '2013-05-09 05:47:42', '', '40');
INSERT INTO `ospos_inventory` VALUES ('261', '45', '1', '2013-05-09 05:47:43', '', '40');
INSERT INTO `ospos_inventory` VALUES ('262', '45', '1', '2013-05-09 05:50:51', '', '20');
INSERT INTO `ospos_inventory` VALUES ('263', '45', '1', '2013-05-09 05:50:58', '', '40');
INSERT INTO `ospos_inventory` VALUES ('264', '45', '1', '2013-05-09 05:51:01', '', '40');
INSERT INTO `ospos_inventory` VALUES ('265', '45', '1', '2013-05-09 05:54:25', '', '3000');
INSERT INTO `ospos_inventory` VALUES ('266', '45', '1', '2013-05-09 05:54:31', '', '-500');
INSERT INTO `ospos_inventory` VALUES ('267', '45', '1', '2013-05-09 05:54:39', '', '100');
INSERT INTO `ospos_inventory` VALUES ('268', '45', '1', '2013-05-10 03:39:38', '', '2000');
INSERT INTO `ospos_inventory` VALUES ('269', '45', '1', '2013-05-10 03:39:46', '', '-802');
INSERT INTO `ospos_inventory` VALUES ('270', '45', '1', '2013-05-10 03:44:17', '', '250');
INSERT INTO `ospos_inventory` VALUES ('271', '45', '1', '2013-05-10 03:48:19', '', '501');
INSERT INTO `ospos_inventory` VALUES ('272', '45', '1', '2013-05-10 03:48:27', '', '-52');
INSERT INTO `ospos_inventory` VALUES ('273', '45', '1', '2013-05-10 04:46:48', '', '400');
INSERT INTO `ospos_inventory` VALUES ('274', '45', '1', '2013-05-10 04:50:11', '', '400');
INSERT INTO `ospos_inventory` VALUES ('275', '45', '1', '2013-05-10 09:33:05', '', '75');
INSERT INTO `ospos_inventory` VALUES ('276', '45', '1', '2013-05-10 09:33:07', '', '75');
INSERT INTO `ospos_inventory` VALUES ('277', '45', '1', '2013-05-13 04:41:57', '', '75');
INSERT INTO `ospos_inventory` VALUES ('278', '45', '1', '2013-05-13 04:57:22', '', '801');
INSERT INTO `ospos_inventory` VALUES ('279', '45', '1', '2013-05-13 08:58:50', '', '20');
INSERT INTO `ospos_inventory` VALUES ('280', '45', '1', '2013-05-13 08:58:55', '', '-5');
INSERT INTO `ospos_inventory` VALUES ('281', '45', '1', '2013-05-13 08:59:01', '', '20');
INSERT INTO `ospos_inventory` VALUES ('282', '45', '1', '2013-05-13 08:59:15', '', '8000');
INSERT INTO `ospos_inventory` VALUES ('283', '45', '1', '2013-05-13 08:59:23', '', '2222');
INSERT INTO `ospos_inventory` VALUES ('284', '45', '1', '2013-05-13 09:12:05', '', '2');
INSERT INTO `ospos_inventory` VALUES ('285', '45', '1', '2013-05-13 09:13:05', '', '752');
INSERT INTO `ospos_inventory` VALUES ('286', '45', '1', '2013-05-20 04:00:26', '', '200');
INSERT INTO `ospos_inventory` VALUES ('287', '45', '1', '2013-05-20 04:00:39', 'A otra bd', '100');
INSERT INTO `ospos_inventory` VALUES ('288', '56', '1', '2013-05-21 09:58:15', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('289', '45', '1', '2013-05-23 05:44:27', 'POS 102', '-100');
INSERT INTO `ospos_inventory` VALUES ('290', '65', '1', '2013-05-25 11:46:59', 'POS 103', '-1');
INSERT INTO `ospos_inventory` VALUES ('291', '43', '1', '2013-05-25 11:56:27', 'POS 104', '-1');
INSERT INTO `ospos_inventory` VALUES ('292', '65', '1', '2013-05-25 12:08:15', 'POS 105', '-1');
INSERT INTO `ospos_inventory` VALUES ('293', '97', '1', '2013-05-28 09:30:28', 'Manual Edit of Quantity', '10');
INSERT INTO `ospos_inventory` VALUES ('294', '97', '1', '2013-05-28 09:32:24', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('295', '97', '1', '2013-05-28 09:32:25', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('296', '97', '1', '2013-05-28 09:34:04', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('297', '98', '1', '2013-11-19 08:16:33', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('298', '99', '1', '2013-11-19 08:16:39', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('299', '100', '1', '2013-11-19 08:16:56', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('300', '101', '1', '2013-11-19 08:16:57', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('301', '102', '1', '2013-11-19 08:16:58', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('302', '103', '1', '2013-11-19 08:17:00', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('303', '104', '1', '2013-11-19 08:17:01', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('304', '105', '1', '2013-11-19 08:17:02', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('305', '106', '1', '2013-11-19 08:17:03', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('306', '107', '1', '2013-11-19 08:17:04', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('307', '108', '1', '2013-11-19 08:17:05', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('308', '109', '1', '2013-11-19 08:17:06', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('309', '110', '1', '2013-11-19 08:17:08', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('310', '111', '1', '2013-11-19 08:17:09', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('311', '112', '1', '2013-11-19 08:17:10', 'Manual Edit of Quantity', '40');
INSERT INTO `ospos_inventory` VALUES ('312', '113', '1', '2013-11-19 08:21:47', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('313', '114', '1', '2013-11-19 08:21:51', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('314', '115', '1', '2013-11-19 08:21:52', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('315', '116', '1', '2013-11-19 08:21:53', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('316', '117', '1', '2013-11-19 08:21:55', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('317', '118', '1', '2013-11-19 08:21:56', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('318', '119', '1', '2013-11-19 08:21:57', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('319', '120', '1', '2013-11-19 08:21:58', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('320', '121', '1', '2013-11-19 08:21:59', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('321', '122', '1', '2013-11-19 08:22:00', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('322', '123', '1', '2013-11-19 08:22:01', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('323', '124', '1', '2013-11-19 08:22:03', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('324', '125', '1', '2013-11-19 08:22:04', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('325', '126', '1', '2013-11-19 08:22:05', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('326', '127', '1', '2013-11-19 08:22:06', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('327', '128', '1', '2013-11-19 08:22:07', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('328', '129', '1', '2013-11-19 08:22:08', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('329', '130', '1', '2013-11-19 08:22:10', 'Manual Edit of Quantity', '2312');
INSERT INTO `ospos_inventory` VALUES ('330', '98', '1', '2013-12-05 08:55:07', 'RECV 2', '1');
INSERT INTO `ospos_inventory` VALUES ('331', '71', '1', '2013-12-05 08:55:07', 'RECV 2', '1');
INSERT INTO `ospos_inventory` VALUES ('332', '8', '1', '2013-12-05 08:55:07', 'RECV 2', '1');
INSERT INTO `ospos_inventory` VALUES ('333', '107', '1', '2013-12-05 09:00:07', 'RECV 3', '1');
INSERT INTO `ospos_inventory` VALUES ('334', '107', '1', '2013-12-05 09:05:50', 'RECV 4', '1');
INSERT INTO `ospos_inventory` VALUES ('335', '98', '1', '2013-12-06 08:52:46', 'RECV 5', '20');
INSERT INTO `ospos_inventory` VALUES ('336', '62', '1', '2013-12-13 12:52:18', 'RECV 6', '1');
INSERT INTO `ospos_inventory` VALUES ('337', '99', '1', '2013-12-13 12:52:19', 'RECV 6', '20');
INSERT INTO `ospos_inventory` VALUES ('338', '20', '1', '2014-01-13 09:11:00', 'RECV 7', '17');
INSERT INTO `ospos_inventory` VALUES ('339', '71', '1', '2014-01-13 09:11:00', 'RECV 7', '4');
INSERT INTO `ospos_inventory` VALUES ('340', '99', '1', '2014-01-13 09:11:00', 'RECV 7', '22');
INSERT INTO `ospos_inventory` VALUES ('341', '100', '1', '2014-01-13 09:11:00', 'RECV 7', '7');
INSERT INTO `ospos_inventory` VALUES ('342', '101', '1', '2014-01-13 09:11:00', 'RECV 7', '12');
INSERT INTO `ospos_inventory` VALUES ('343', '102', '1', '2014-01-13 09:11:00', 'RECV 7', '23');
INSERT INTO `ospos_inventory` VALUES ('344', '103', '1', '2014-01-13 09:11:00', 'RECV 7', '78');
INSERT INTO `ospos_inventory` VALUES ('345', '20', '1', '2014-01-13 09:21:20', 'RECV 8', '17');
INSERT INTO `ospos_inventory` VALUES ('346', '71', '1', '2014-01-13 09:21:20', 'RECV 8', '4');
INSERT INTO `ospos_inventory` VALUES ('347', '99', '1', '2014-01-13 09:21:20', 'RECV 8', '22');
INSERT INTO `ospos_inventory` VALUES ('348', '100', '1', '2014-01-13 09:21:20', 'RECV 8', '7');
INSERT INTO `ospos_inventory` VALUES ('349', '101', '1', '2014-01-13 09:21:20', 'RECV 8', '12');
INSERT INTO `ospos_inventory` VALUES ('350', '102', '1', '2014-01-13 09:21:20', 'RECV 8', '23');
INSERT INTO `ospos_inventory` VALUES ('351', '103', '1', '2014-01-13 09:21:20', 'RECV 8', '78');
INSERT INTO `ospos_inventory` VALUES ('352', '111', '1', '2014-01-13 09:48:24', 'RECV 9', '1');
INSERT INTO `ospos_inventory` VALUES ('353', '112', '1', '2014-01-13 09:48:24', 'RECV 9', '1');
INSERT INTO `ospos_inventory` VALUES ('354', '104', '1', '2014-01-15 13:33:41', 'RECV 10', '2');
INSERT INTO `ospos_inventory` VALUES ('355', '105', '1', '2014-01-15 13:33:41', 'RECV 10', '4');
INSERT INTO `ospos_inventory` VALUES ('356', '106', '1', '2014-01-15 13:33:41', 'RECV 10', '6');
INSERT INTO `ospos_inventory` VALUES ('357', '104', '1', '2014-01-15 13:36:26', 'RECV 11', '8');
INSERT INTO `ospos_inventory` VALUES ('358', '104', '1', '2014-01-15 13:37:16', 'RECV 12', '8');
INSERT INTO `ospos_inventory` VALUES ('359', '104', '1', '2014-01-17 12:52:50', 'RECV 13', '2');
INSERT INTO `ospos_inventory` VALUES ('360', '105', '1', '2014-01-17 12:52:50', 'RECV 13', '4');
INSERT INTO `ospos_inventory` VALUES ('361', '106', '1', '2014-01-17 12:52:50', 'RECV 13', '6');
INSERT INTO `ospos_inventory` VALUES ('362', '104', '1', '2014-01-20 07:29:07', 'RECV 14', '8');
INSERT INTO `ospos_inventory` VALUES ('363', '104', '1', '2014-01-20 07:32:03', 'RECV 15', '8');
INSERT INTO `ospos_inventory` VALUES ('364', '104', '1', '2014-01-20 07:32:34', 'RECV 16', '2');
INSERT INTO `ospos_inventory` VALUES ('365', '105', '1', '2014-01-20 07:32:34', 'RECV 16', '4');
INSERT INTO `ospos_inventory` VALUES ('366', '106', '1', '2014-01-20 07:32:34', 'RECV 16', '6');
INSERT INTO `ospos_inventory` VALUES ('367', '1', '1', '2014-01-20 07:34:58', 'RECV 17', '20');
INSERT INTO `ospos_inventory` VALUES ('368', '20', '1', '2014-01-20 07:34:58', 'RECV 17', '5');
INSERT INTO `ospos_inventory` VALUES ('369', '82', '1', '2014-01-20 07:34:58', 'RECV 17', '1');
INSERT INTO `ospos_inventory` VALUES ('370', '1', '1', '2014-01-20 07:38:02', 'RECV 18', '20');
INSERT INTO `ospos_inventory` VALUES ('371', '20', '1', '2014-01-20 07:38:02', 'RECV 18', '5');
INSERT INTO `ospos_inventory` VALUES ('372', '82', '1', '2014-01-20 07:38:02', 'RECV 18', '1');
INSERT INTO `ospos_inventory` VALUES ('373', '20', '1', '2014-01-20 07:42:48', 'RECV 19', '17');
INSERT INTO `ospos_inventory` VALUES ('374', '71', '1', '2014-01-20 07:42:48', 'RECV 19', '4');
INSERT INTO `ospos_inventory` VALUES ('375', '99', '1', '2014-01-20 07:42:48', 'RECV 19', '22');
INSERT INTO `ospos_inventory` VALUES ('376', '100', '1', '2014-01-20 07:42:48', 'RECV 19', '7');
INSERT INTO `ospos_inventory` VALUES ('377', '101', '1', '2014-01-20 07:42:48', 'RECV 19', '12');
INSERT INTO `ospos_inventory` VALUES ('378', '102', '1', '2014-01-20 07:42:48', 'RECV 19', '23');
INSERT INTO `ospos_inventory` VALUES ('379', '103', '1', '2014-01-20 07:42:48', 'RECV 19', '78');
INSERT INTO `ospos_inventory` VALUES ('380', '104', '1', '2014-01-20 11:53:46', 'RECV 20', '8');
INSERT INTO `ospos_inventory` VALUES ('381', '104', '1', '2014-01-20 12:01:47', 'RECV 21', '8');
INSERT INTO `ospos_inventory` VALUES ('382', '104', '1', '2014-01-20 12:49:44', 'RECV 22', '8');
INSERT INTO `ospos_inventory` VALUES ('383', '104', '1', '2014-01-20 12:50:46', 'RECV 23', '2');
INSERT INTO `ospos_inventory` VALUES ('384', '105', '1', '2014-01-20 12:50:46', 'RECV 23', '4');
INSERT INTO `ospos_inventory` VALUES ('385', '106', '1', '2014-01-20 12:50:46', 'RECV 23', '6');
INSERT INTO `ospos_inventory` VALUES ('386', '104', '1', '2014-01-20 13:07:49', 'RECV 24', '8');
INSERT INTO `ospos_inventory` VALUES ('387', '104', '1', '2014-01-20 13:18:40', 'RECV 25', '8');
INSERT INTO `ospos_inventory` VALUES ('388', '104', '1', '2014-01-20 13:19:53', 'RECV 26', '8');
INSERT INTO `ospos_inventory` VALUES ('389', '104', '1', '2014-01-20 13:30:50', 'RECV 27', '8');
INSERT INTO `ospos_inventory` VALUES ('390', '108', '1', '2014-01-20 13:31:37', 'RECV 28', '1');
INSERT INTO `ospos_inventory` VALUES ('391', '108', '1', '2014-01-20 13:32:04', 'RECV 29', '1');
INSERT INTO `ospos_inventory` VALUES ('392', '20', '1', '2014-01-20 13:33:07', 'RECV 30', '17');
INSERT INTO `ospos_inventory` VALUES ('393', '71', '1', '2014-01-20 13:33:07', 'RECV 30', '4');
INSERT INTO `ospos_inventory` VALUES ('394', '99', '1', '2014-01-20 13:33:07', 'RECV 30', '22');
INSERT INTO `ospos_inventory` VALUES ('395', '100', '1', '2014-01-20 13:33:07', 'RECV 30', '7');
INSERT INTO `ospos_inventory` VALUES ('396', '101', '1', '2014-01-20 13:33:07', 'RECV 30', '12');
INSERT INTO `ospos_inventory` VALUES ('397', '102', '1', '2014-01-20 13:33:07', 'RECV 30', '23');
INSERT INTO `ospos_inventory` VALUES ('398', '103', '1', '2014-01-20 13:33:07', 'RECV 30', '78');
INSERT INTO `ospos_inventory` VALUES ('399', '104', '1', '2014-01-20 13:41:21', 'RECV 31', '8');
INSERT INTO `ospos_inventory` VALUES ('400', '20', '1', '2014-01-20 14:27:13', 'RECV 32', '17');
INSERT INTO `ospos_inventory` VALUES ('401', '71', '1', '2014-01-20 14:27:13', 'RECV 32', '4');
INSERT INTO `ospos_inventory` VALUES ('402', '99', '1', '2014-01-20 14:27:13', 'RECV 32', '22');
INSERT INTO `ospos_inventory` VALUES ('403', '100', '1', '2014-01-20 14:27:13', 'RECV 32', '7');
INSERT INTO `ospos_inventory` VALUES ('404', '101', '1', '2014-01-20 14:27:13', 'RECV 32', '12');
INSERT INTO `ospos_inventory` VALUES ('405', '102', '1', '2014-01-20 14:27:13', 'RECV 32', '23');
INSERT INTO `ospos_inventory` VALUES ('406', '103', '1', '2014-01-20 14:27:13', 'RECV 32', '78');
INSERT INTO `ospos_inventory` VALUES ('407', '104', '1', '2014-01-20 15:12:44', 'RECV 33', '8');
INSERT INTO `ospos_inventory` VALUES ('408', '104', '1', '2014-01-20 15:18:49', 'RECV 34', '8');
INSERT INTO `ospos_inventory` VALUES ('409', '108', '1', '2014-01-21 14:42:02', 'RECV 35', '1');
INSERT INTO `ospos_inventory` VALUES ('410', '108', '1', '2014-01-21 14:52:22', 'RECV 36', '1');
INSERT INTO `ospos_inventory` VALUES ('411', '108', '1', '2014-01-21 14:54:56', 'RECV 37', '1');
INSERT INTO `ospos_inventory` VALUES ('412', '1', '1', '2014-01-21 14:58:36', 'RECV 38', '20');
INSERT INTO `ospos_inventory` VALUES ('413', '20', '1', '2014-01-21 14:58:36', 'RECV 38', '5');
INSERT INTO `ospos_inventory` VALUES ('414', '82', '1', '2014-01-21 14:58:36', 'RECV 38', '1');
INSERT INTO `ospos_inventory` VALUES ('415', '1', '1', '2014-01-21 15:00:09', 'RECV 39', '20');
INSERT INTO `ospos_inventory` VALUES ('416', '20', '1', '2014-01-21 15:00:09', 'RECV 39', '5');
INSERT INTO `ospos_inventory` VALUES ('417', '82', '1', '2014-01-21 15:00:09', 'RECV 39', '1');
INSERT INTO `ospos_inventory` VALUES ('418', '108', '1', '2014-01-22 14:54:56', 'RECV 40', '1');
INSERT INTO `ospos_inventory` VALUES ('419', '20', '1', '2014-01-22 15:02:37', 'RECV 41', '17');
INSERT INTO `ospos_inventory` VALUES ('420', '71', '1', '2014-01-22 15:02:37', 'RECV 41', '4');
INSERT INTO `ospos_inventory` VALUES ('421', '99', '1', '2014-01-22 15:02:37', 'RECV 41', '22');
INSERT INTO `ospos_inventory` VALUES ('422', '100', '1', '2014-01-22 15:02:37', 'RECV 41', '7');
INSERT INTO `ospos_inventory` VALUES ('423', '101', '1', '2014-01-22 15:02:37', 'RECV 41', '12');
INSERT INTO `ospos_inventory` VALUES ('424', '102', '1', '2014-01-22 15:02:37', 'RECV 41', '23');
INSERT INTO `ospos_inventory` VALUES ('425', '103', '1', '2014-01-22 15:02:37', 'RECV 41', '78');
INSERT INTO `ospos_inventory` VALUES ('426', '20', '1', '2014-01-22 15:15:47', 'RECV 42', '17');
INSERT INTO `ospos_inventory` VALUES ('427', '71', '1', '2014-01-22 15:15:47', 'RECV 42', '4');
INSERT INTO `ospos_inventory` VALUES ('428', '99', '1', '2014-01-22 15:15:47', 'RECV 42', '22');
INSERT INTO `ospos_inventory` VALUES ('429', '100', '1', '2014-01-22 15:15:47', 'RECV 42', '7');
INSERT INTO `ospos_inventory` VALUES ('430', '101', '1', '2014-01-22 15:15:47', 'RECV 42', '12');
INSERT INTO `ospos_inventory` VALUES ('431', '102', '1', '2014-01-22 15:15:47', 'RECV 42', '23');
INSERT INTO `ospos_inventory` VALUES ('432', '103', '1', '2014-01-22 15:15:47', 'RECV 42', '78');
INSERT INTO `ospos_inventory` VALUES ('433', '9', '1', '2014-01-23 08:03:04', 'POS 106', '-1');
INSERT INTO `ospos_inventory` VALUES ('434', '69', '1', '2014-01-23 08:03:04', 'POS 106', '-1');
INSERT INTO `ospos_inventory` VALUES ('435', '98', '1', '2014-01-23 09:08:51', 'POS 107', '-1');
INSERT INTO `ospos_inventory` VALUES ('436', '106', '1', '2014-01-23 09:08:51', 'POS 107', '-1');
INSERT INTO `ospos_inventory` VALUES ('437', '106', '1', '2014-01-23 12:17:50', 'POS 108', '-1');
INSERT INTO `ospos_inventory` VALUES ('438', '106', '1', '2014-01-23 12:37:10', 'POS 109', '-2');
INSERT INTO `ospos_inventory` VALUES ('439', '98', '1', '2014-01-27 07:57:17', 'POS 110', '-1');
INSERT INTO `ospos_inventory` VALUES ('440', '98', '1', '2014-01-27 13:35:06', 'POS 111', '-1');
INSERT INTO `ospos_inventory` VALUES ('441', '98', '1', '2014-01-27 13:35:45', 'POS 112', '-1');
INSERT INTO `ospos_inventory` VALUES ('442', '106', '1', '2014-01-27 14:25:57', 'POS 113', '-3');
INSERT INTO `ospos_inventory` VALUES ('443', '98', '1', '2014-01-27 14:25:57', 'POS 113', '-6');
INSERT INTO `ospos_inventory` VALUES ('444', '98', '1', '2014-01-28 12:08:25', 'POS 114', '-16');
INSERT INTO `ospos_inventory` VALUES ('445', '108', '1', '2014-01-28 12:08:25', 'POS 114', '-11');
INSERT INTO `ospos_inventory` VALUES ('446', '98', '1', '2014-01-28 12:17:34', 'POS 115', '-1');
INSERT INTO `ospos_inventory` VALUES ('447', '45', '1', '2014-01-28 12:19:10', 'POS 116', '-6');
INSERT INTO `ospos_inventory` VALUES ('448', '34', '1', '2014-01-28 12:24:59', 'POS 117', '-6');
INSERT INTO `ospos_inventory` VALUES ('449', '106', '1', '2014-01-28 14:38:23', 'POS 1', '-5');
INSERT INTO `ospos_inventory` VALUES ('450', '106', '1', '2014-01-28 14:42:56', 'POS 2', '-6');
INSERT INTO `ospos_inventory` VALUES ('451', '109', '1', '2014-01-28 14:42:56', 'POS 2', '-1');
INSERT INTO `ospos_inventory` VALUES ('452', '106', '1', '2014-01-28 14:44:33', 'POS 1', '-6');
INSERT INTO `ospos_inventory` VALUES ('453', '106', '1', '2014-01-28 14:45:55', 'POS 2', '-4');
INSERT INTO `ospos_inventory` VALUES ('454', '110', '1', '2014-01-28 14:45:55', 'POS 2', '-3');
INSERT INTO `ospos_inventory` VALUES ('455', '102', '1', '2014-01-29 07:11:28', 'POS 1', '-161');
INSERT INTO `ospos_inventory` VALUES ('456', '50', '1', '2014-01-29 07:13:30', 'POS 2', '-3');
INSERT INTO `ospos_inventory` VALUES ('457', '85', '1', '2014-01-29 07:29:15', 'POS 1', '-1');
INSERT INTO `ospos_inventory` VALUES ('458', '106', '1', '2014-01-29 07:33:44', 'POS 2', '-2');
INSERT INTO `ospos_inventory` VALUES ('459', '58', '1', '2014-01-29 07:51:40', 'POS 3', '-1');
INSERT INTO `ospos_inventory` VALUES ('460', '106', '1', '2014-01-29 07:53:02', 'POS 4', '-2');
INSERT INTO `ospos_inventory` VALUES ('461', '109', '1', '2014-01-29 07:53:02', 'POS 4', '-2');
INSERT INTO `ospos_inventory` VALUES ('462', '111', '1', '2014-01-29 07:53:02', 'POS 4', '-1');
INSERT INTO `ospos_inventory` VALUES ('463', '105', '1', '2014-01-29 07:55:45', 'POS 5', '-2');
INSERT INTO `ospos_inventory` VALUES ('464', '106', '1', '2014-01-29 08:43:02', 'POS 6', '-2');
INSERT INTO `ospos_inventory` VALUES ('465', '110', '1', '2014-01-29 08:44:01', 'POS 7', '-2');
INSERT INTO `ospos_inventory` VALUES ('466', '106', '1', '2014-02-04 08:08:37', 'POS 8', '-6');
INSERT INTO `ospos_inventory` VALUES ('467', '109', '1', '2014-02-04 08:08:37', 'POS 8', '-18');
INSERT INTO `ospos_inventory` VALUES ('468', '111', '1', '2014-02-04 08:08:37', 'POS 8', '-8');
INSERT INTO `ospos_inventory` VALUES ('469', '9', '1', '2014-02-04 08:10:11', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('470', '45', '1', '2014-02-04 08:10:51', 'Manual Edit of Quantity', '0');
INSERT INTO `ospos_inventory` VALUES ('471', '9', '1', '2014-02-04 08:13:34', 'POS 9', '-1');
INSERT INTO `ospos_inventory` VALUES ('472', '104', '1', '2014-02-04 08:17:56', 'RECV 43', '8');
INSERT INTO `ospos_inventory` VALUES ('473', '98', '1', '2014-02-06 07:47:26', 'POS 10', '-1');
INSERT INTO `ospos_inventory` VALUES ('474', '106', '1', '2014-03-05 14:42:20', 'RECV 44', '2');

-- ----------------------------
-- Table structure for `ospos_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_items`;
CREATE TABLE `ospos_items` (
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item_number` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `cost_price` double(15,2) NOT NULL,
  `unit_price` double(15,2) NOT NULL,
  `quantity` double(15,2) NOT NULL DEFAULT '0.00',
  `reorder_level` double(15,2) NOT NULL DEFAULT '0.00',
  `location` varchar(255) NOT NULL,
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `allow_alt_description` tinyint(1) NOT NULL,
  `is_serialized` tinyint(1) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `broken_quantity` int(15) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_number` (`item_number`),
  KEY `ospos_items_ibfk_1` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_items
-- ----------------------------
INSERT INTO `ospos_items` VALUES ('Iphone 3G Digitizer', 'Digitizers', null, null, '', '13.00', '30.00', '156.00', '20.00', '', '1', '0', '0', '0', '2');
INSERT INTO `ospos_items` VALUES ('Iphone 3G LCD', 'LCDs', null, null, '', '20.00', '35.00', '27.00', '10.00', '', '2', '0', '0', '0', '1');
INSERT INTO `ospos_items` VALUES ('Repair Service', 'Services', null, null, '', '30.00', '30.00', '999.00', '1.00', '', '3', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Digitizer', 'iPhone', null, null, '', '0.00', '50.00', '2.00', '3.00', '', '4', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Screen Protector', 'Accessories', null, null, '', '0.00', '10.00', '37.00', '10.00', '', '5', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('LifeProof Case', 'Accessories', null, null, '', '0.00', '85.00', '11.00', '5.00', '', '6', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad Protect Case', 'Accessories', null, null, '', '0.00', '49.99', '5.00', '2.00', '', '7', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Iphone 3gs Back', 'Accessories', null, null, '', '0.00', '75.00', '111.00', '0.00', '', '8', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3G Digitizer', 'iPhone', null, '01020304', '', '0.00', '45.00', '3.00', '2.00', '', '9', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 2 Screen Black', 'Ipad', null, null, '', '0.00', '125.00', '33.00', '1.00', '', '10', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 2 Screen White ', 'Ipad', null, null, '', '0.00', '125.00', '121.00', '1.00', '', '11', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 3 Screen White', 'Ipad', null, null, '', '0.00', '200.00', '34.00', '0.00', '', '12', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 3 Screen Black', 'Ipad', null, null, '', '0.00', '200.00', '20.00', '0.00', '', '13', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Back White', 'iPhone', null, null, '', '0.00', '30.00', '10.00', '2.00', '', '14', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Back Black', 'iPhone', null, null, '', '0.00', '30.00', '10.00', '2.00', '', '15', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Back white', 'iPhone', null, null, '', '0.00', '30.00', '4.00', '2.00', '', '16', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s Back Black', 'iPhone', null, null, '', '0.00', '30.00', '9.00', '2.00', '', '17', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Black Screen', 'iPhone', null, null, '', '0.00', '79.95', '10.00', '3.00', '', '18', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM White Screen', 'iPhone', null, null, '', '0.00', '79.95', '10.00', '3.00', '', '19', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA White screen', 'iPhone', null, null, '', '0.00', '79.95', '143.00', '2.00', '', '20', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Black Screen', 'iPhone', null, null, '', '0.00', '79.95', '5.00', '2.00', '', '21', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s white Screen', 'iPhone', null, null, '', '0.00', '89.95', '7.00', '3.00', '', '22', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s Black screen', 'iPhone', null, null, '', '0.00', '89.95', '9.00', '3.00', '', '23', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3gs lcd', 'iPhone', null, null, '', '0.00', '65.00', '213.00', '1.00', '', '24', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color set Pink', 'iPhone', null, null, '', '0.00', '120.00', '432.00', '1.00', '', '25', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM color set pink', 'iPhone', null, null, '', '0.00', '110.00', '654.00', '1.00', '', '26', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color set Red', 'iPhone', null, null, '', '0.00', '120.00', '54.00', '0.00', '', '27', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM color set red', 'iPhone', null, null, '', '0.00', '110.00', '55.00', '0.00', '', '28', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 gsm color front', 'iPhone', null, null, '', '0.00', '89.95', '65.00', '1.00', '', '29', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 gsm color back', 'iPhone', null, null, '', '0.00', '35.00', '4.00', '1.00', '', '30', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color front screen', 'iPhone', null, null, '', '0.00', '95.00', '7.00', '2.00', '', '31', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color back', 'iPhone', null, null, '', '0.00', '35.00', '6.00', '2.00', '', '32', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA color front screen', 'iPhone', null, null, '', '0.00', '89.95', '2367.00', '0.00', '', '33', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA color backs', 'iPhone', null, null, '', '0.00', '35.00', '648.00', '0.00', '', '34', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA color backs', 'iPhone', null, null, '', '0.00', '35.00', '123.00', '0.00', '', '35', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Repair', 'iPhone', null, null, '', '0.00', '0.00', '-6.00', '0.00', '', '36', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Black Front', 'iPhone', null, null, '', '0.00', '75.00', '7.00', '2.00', '', '37', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM White Front', 'iPhone', null, null, '', '0.00', '75.00', '10.00', '2.00', '', '38', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA White Front', 'iPhone', null, null, '', '0.00', '75.00', '78.00', '2.00', '', '39', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Black Front', 'iPhone', null, null, '', '0.00', '75.00', '5.00', '2.00', '', '40', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Black Front', 'iPhone', null, null, '', '0.00', '75.00', '8.00', '2.00', '', '41', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S White Front', 'iPhone', null, null, '', '0.00', '75.00', '3.00', '2.00', '', '42', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('iPad 2 Home Button', 'iPhone', null, null, '', '0.00', '45.00', '8.00', '2.00', '', '43', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS LCD', 'iPhone', null, null, '', '0.00', '45.00', '1.00', '0.00', '', '44', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3G Digitizer', 'iPhone', null, '010203', '', '0.00', '45.00', '743.00', '2.00', '', '45', '0', '1', '0', '4');
INSERT INTO `ospos_items` VALUES ('4 GSM White Back', 'iPhone', null, null, '', '0.00', '25.00', '9.00', '2.00', '', '46', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Black Back', 'iPhone', null, null, '', '0.00', '25.00', '7.00', '2.00', '', '47', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S White Back', 'iPhone', null, null, '', '0.00', '25.00', '324.00', '2.00', '', '48', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Black Back', 'iPhone', null, null, '', '0.00', '25.00', '9.00', '2.00', '', '49', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Back Assembly', 'iPhone', null, null, '', '0.00', '75.00', '30.00', '0.00', '', '50', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 Home Flex', 'iPhone', null, null, '', '0.00', '45.00', '5.00', '2.00', '', '51', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Vibrator', 'iPhone', null, null, '', '0.00', '25.00', '435.00', '1.00', '', '52', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Audio Jack', 'iPhone', null, null, '', '0.00', '50.00', '34.00', '1.00', '', '53', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Power Flex', 'iPhone', null, null, '', '0.00', '50.00', '5.00', '2.00', '', '54', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Digitizer', 'ipad', null, null, '', '0.00', '100.00', '-4.00', '0.00', '', '55', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 Back Camera', 'iPhone', null, null, '', '0.00', '35.00', '2.00', '1.00', '', '56', '1', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Front Camera', 'iPhone', null, null, '', '0.00', '40.00', '67.00', '1.00', '', '57', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Dock', 'iPhone', null, null, '', '0.00', '50.00', '4.00', '1.00', '', '58', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Power Flex', 'iPhone', null, null, '', '0.00', '50.00', '5.00', '2.00', '', '59', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Home Flex', 'iPhone', null, null, '', '0.00', '45.00', '5.00', '2.00', '', '60', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Home Flex', 'iPhone', null, null, '', '0.00', '25.00', '88.00', '2.00', '', '61', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('CDMA Audio Jack', 'iPhone', null, null, '', '0.00', '50.00', '5.00', '2.00', '', '62', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('iPad 2 Power Flex', 'ipad', null, null, '', '0.00', '100.00', '21.00', '0.00', '', '63', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Power Flex', 'iPhone', null, null, '', '0.00', '50.00', '3.00', '1.00', '', '64', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Battery', 'iPhone', null, null, '', '0.00', '40.00', '-2.00', '1.00', '', '65', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4G Battery', 'iPhone', null, null, '', '0.00', '40.00', '9.00', '2.00', '', '66', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Battery', 'iPhone', null, null, '', '0.00', '35.00', '4.00', '1.00', '', '67', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA / 4S Vibrator', 'iPhone', null, null, '', '0.00', '35.00', '-1.00', '0.00', '', '68', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3G Dock', 'iPhone', null, null, '', '0.00', '35.00', '203.00', '0.00', '', '69', '0', '0', '0', '2');
INSERT INTO `ospos_items` VALUES ('4 GSM Boom Box', 'iPhone', null, null, '', '0.00', '45.00', '98.00', '0.00', '', '70', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('CDMA / 4S Boom Box', 'iPhone', null, null, '', '0.00', '45.00', '32.00', '1.00', '', '71', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Audio Jack', 'iPhone', null, null, '', '0.00', '50.00', '65.00', '0.00', '', '72', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Charging Dock', 'iPhone', null, null, '', '0.00', '45.00', '6.00', '2.00', '', '73', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('CDMA Dock Assembly', 'iPhone', null, null, '', '0.00', '45.00', '4.00', '2.00', '', '74', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Charging Dock', 'iPhone', null, null, '', '0.00', '45.00', '4.00', '2.00', '', '75', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Life Proof Case', 'Accessories', null, null, '', '59.00', '89.99', '6.00', '5.00', '', '76', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('iPad Case', 'Accessories', null, null, '', '0.00', '49.99', '4.00', '2.00', '', '77', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('OtterBox Case', 'Accessories', null, null, '', '0.00', '49.99', '5.00', '2.00', '', '78', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Screen Protector', 'Accessories', null, null, '', '0.00', '10.00', '33.00', '20.00', '', '79', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Color Front', 'iPhone', null, null, '', '0.00', '85.00', '3.00', '2.00', '', '80', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Color Back', 'iPhone', null, null, '', '0.00', '25.00', '5.00', '2.00', '', '81', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Color Front', 'iPhone', null, null, '', '0.00', '75.00', '7.00', '2.00', '', '82', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Color Back', 'iPhone', null, null, '', '0.00', '25.00', '4.00', '2.00', '', '83', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Color Front', 'iPhone', null, null, '', '0.00', '75.00', '3.00', '2.00', '', '84', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Color Back', 'iPhone', null, null, '', '0.00', '25.00', '2.00', '2.00', '', '85', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('itouch 4 Black Front', 'ipod', null, null, '', '0.00', '85.00', '9.00', '2.00', '', '86', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('itouch 4 White Front', 'ipod', null, null, '', '0.00', '85.00', '10.00', '2.00', '', '87', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Unlock Service', 'Repair', null, null, '', '0.00', '60.00', '90.00', '0.00', '', '88', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Repair Service', 'Repair', null, null, '', '0.00', '0.00', '63.00', '0.00', '', '89', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Data Cable', 'Accessories', null, null, '', '0.00', '10.00', '43.00', '0.00', '', '90', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('HTC EVO Assembly', 'HTC', null, null, '', '0.00', '105.00', '3.00', '1.00', '', '91', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Mytouch 4G Front Assembly', 'HTC', null, null, '', '0.00', '100.00', '3.00', '1.00', '', '92', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Mytouch 3G Slide', 'Phone', null, null, '', '15.00', '0.00', '1.00', '0.00', '', '93', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Battery Back Case', 'Accessories', null, null, '', '0.00', '0.00', '81.00', '1.00', '', '94', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Phone Case', 'Accessories', null, null, '', '0.00', '25.00', '13.00', '5.00', '', '95', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('culo', 'iPhone', null, null, '', '200.00', '100.00', '99.00', '2.00', '', '96', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('tiger blood', 'smoke', null, 'UEN', 'bdghkaghdagkasg', '30.00', '10.00', '10.00', '5.00', 'where', '97', '1', '1', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 1', 'Blackberry', null, null, '', '1200.00', '369.00', '33.00', '10.00', '', '98', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 2', 'Blackberry', null, null, '', '1200.00', '400.00', '214.00', '10.00', '', '99', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 4', 'Blackberry', null, null, '', '1200.00', '256.00', '89.00', '10.00', '', '100', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 5', 'Blackberry', null, null, '', '1200.00', '125.00', '123.00', '10.00', '', '101', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 6', 'Blackberry', null, null, '', '1200.00', '80.00', '40.00', '10.00', '', '102', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 7', 'Blackberry', null, null, '', '1200.00', '66.00', '586.00', '10.00', '', '103', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 8', 'Blackberry', null, null, '', '1200.00', '593.00', '158.00', '10.00', '', '104', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 9', 'Blackberry', null, null, '', '1200.00', '200.00', '50.00', '10.00', '', '105', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 10', 'Blackberry', null, null, '', '1200.00', '224.00', '20.00', '10.00', '', '106', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 11', 'Blackberry', null, null, '', '1200.00', '37.00', '42.00', '10.00', '', '107', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 12', 'Blackberry', null, null, '', '1200.00', '69.50', '34.00', '10.00', '', '108', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 13', 'Blackberry', null, null, '', '1200.00', '80.90', '18.00', '10.00', '', '109', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 14', 'Blackberry', null, null, '', '1200.00', '200.00', '28.00', '10.00', '', '110', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 15', 'Blackberry', null, null, '', '1200.00', '156.00', '31.00', '10.00', '', '111', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 16', 'Blackberry', null, null, '', '1200.00', '187.00', '40.00', '10.00', '', '112', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `ospos_items_taxes`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_items_taxes`;
CREATE TABLE `ospos_items_taxes` (
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` double(15,3) NOT NULL,
  PRIMARY KEY (`item_id`,`name`,`percent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_items_taxes
-- ----------------------------
INSERT INTO `ospos_items_taxes` VALUES ('1', 'Local Sales Tax', '8.375');
INSERT INTO `ospos_items_taxes` VALUES ('2', 'Local Sales Tax', '8.375');
INSERT INTO `ospos_items_taxes` VALUES ('3', 'Local Sales Tax', '8.375');
INSERT INTO `ospos_items_taxes` VALUES ('4', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('5', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('6', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('7', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('8', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('9', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('10', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('11', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('12', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('13', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('14', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('15', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('16', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('17', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('18', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('19', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('20', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('21', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('22', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('23', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('24', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('25', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('26', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('27', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('28', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('29', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('30', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('31', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('32', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('33', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('34', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('35', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('36', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('37', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('38', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('39', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('40', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('41', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('42', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('43', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('44', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('45', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('46', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('47', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('48', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('49', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('50', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('51', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('52', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('53', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('54', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('55', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('56', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('57', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('58', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('59', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('60', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('61', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('62', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('63', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('64', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('65', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('66', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('67', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('68', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('69', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('70', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('71', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('72', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('73', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('74', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('75', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('76', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('77', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('78', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('79', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('80', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('81', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('82', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('83', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('84', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('85', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('86', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('87', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('88', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('89', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('90', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('91', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('92', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('93', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('94', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('95', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('96', 'Sales Tax', '7.000');
INSERT INTO `ospos_items_taxes` VALUES ('97', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('98', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('99', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('100', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('101', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('102', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('103', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('104', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('105', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('106', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('107', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('108', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('109', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('110', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('111', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('112', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('113', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('114', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('115', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('116', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('117', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('118', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('119', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('120', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('121', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('122', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('123', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('124', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('125', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('126', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('127', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('128', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('129', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('130', 'Sales Tax', '8.365');

-- ----------------------------
-- Table structure for `ospos_item_kits`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_item_kits`;
CREATE TABLE `ospos_item_kits` (
  `item_kit_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`item_kit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_item_kits
-- ----------------------------
INSERT INTO `ospos_item_kits` VALUES ('1', 'Primer kit', 'HOla');

-- ----------------------------
-- Table structure for `ospos_item_kit_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_item_kit_items`;
CREATE TABLE `ospos_item_kit_items` (
  `item_kit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double(15,2) NOT NULL,
  PRIMARY KEY (`item_kit_id`,`item_id`,`quantity`),
  KEY `ospos_item_kit_items_ibfk_2` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_item_kit_items
-- ----------------------------
INSERT INTO `ospos_item_kit_items` VALUES ('1', '21', '3.00');
INSERT INTO `ospos_item_kit_items` VALUES ('1', '110', '1.00');

-- ----------------------------
-- Table structure for `ospos_modules`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_modules`;
CREATE TABLE `ospos_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `options` varchar(100) DEFAULT 'none',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_modules
-- ----------------------------
INSERT INTO `ospos_modules` VALUES ('module_config', 'module_config_desc', '100', 'config', 'save');
INSERT INTO `ospos_modules` VALUES ('module_customers', 'module_customers_desc', '10', 'customers', 'add,update,delete');
INSERT INTO `ospos_modules` VALUES ('module_employees', 'module_employees_desc', '80', 'employees', 'add,update,delete');
INSERT INTO `ospos_modules` VALUES ('module_giftcards', 'module_giftcards_desc', '90', 'giftcards', 'add,update,delete');
INSERT INTO `ospos_modules` VALUES ('module_items', 'module_items_desc', '20', 'items', 'add,update,delete');
INSERT INTO `ospos_modules` VALUES ('module_item_kits', 'module_item_kits_desc', '30', 'item_kits', 'add,update,delete');
INSERT INTO `ospos_modules` VALUES ('module_receivings', 'module_receivings_desc', '60', 'receivings', 'none');
INSERT INTO `ospos_modules` VALUES ('module_reports', 'module_reports_desc', '50', 'reports', 'none');
INSERT INTO `ospos_modules` VALUES ('module_sales', 'module_sales_desc', '70', 'sales', 'none');
INSERT INTO `ospos_modules` VALUES ('module_suppliers', 'module_suppliers_desc', '40', 'suppliers', 'add,update,delete');

-- ----------------------------
-- Table structure for `ospos_people`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_people`;
CREATE TABLE `ospos_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `comments` text,
  `person_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`person_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_people
-- ----------------------------
INSERT INTO `ospos_people` VALUES ('Alex', 'Kundalia', '555-555-5555', 'info@om-parts.com', 'Address 1', '', '', '', '', '', '', '1');
INSERT INTO `ospos_people` VALUES ('other', 'possp2', null, null, 'localhost', null, null, null, null, null, 'location', '2');
INSERT INTO `ospos_people` VALUES ('Jv ', 'Soluciones', '', '', '', '', '', '', '', '', '', '3');
INSERT INTO `ospos_people` VALUES ('speed', 'speed', '', '', '', '', '', '', '', '', '', '4');

-- ----------------------------
-- Table structure for `ospos_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_permissions`;
CREATE TABLE `ospos_permissions` (
  `module_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`person_id`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_permissions
-- ----------------------------
INSERT INTO `ospos_permissions` VALUES ('config', '1');
INSERT INTO `ospos_permissions` VALUES ('customers', '1');
INSERT INTO `ospos_permissions` VALUES ('employees', '1');
INSERT INTO `ospos_permissions` VALUES ('giftcards', '1');
INSERT INTO `ospos_permissions` VALUES ('items', '1');
INSERT INTO `ospos_permissions` VALUES ('items', '4');
INSERT INTO `ospos_permissions` VALUES ('item_kits', '1');
INSERT INTO `ospos_permissions` VALUES ('receivings', '1');
INSERT INTO `ospos_permissions` VALUES ('reports', '1');
INSERT INTO `ospos_permissions` VALUES ('sales', '1');
INSERT INTO `ospos_permissions` VALUES ('sales', '4');
INSERT INTO `ospos_permissions` VALUES ('suppliers', '1');

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
  PRIMARY KEY (`receiving_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_receivings
-- ----------------------------
INSERT INTO `ospos_receivings` VALUES ('2012-11-23 11:52:28', null, '6', '', '1', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2013-12-05 10:25:06', null, '1', 'All done', '2', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2013-12-05 10:30:07', null, '1', '', '3', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2013-12-05 10:35:50', null, '1', '', '4', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2013-12-06 10:22:46', null, '1', '', '5', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2013-12-13 14:22:18', null, '1', '', '6', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-13 10:40:59', null, '1', '', '7', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-13 10:51:20', null, '1', '', '8', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-13 11:18:24', null, '1', '', '9', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-15 15:03:41', null, '1', '', '10', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-15 15:06:26', null, '1', '', '11', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-15 15:07:16', null, '1', '', '12', 'Cash');
INSERT INTO `ospos_receivings` VALUES ('2014-01-17 14:22:50', null, '1', '', '13', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 08:59:07', null, '1', '', '14', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:02:03', null, '1', '', '15', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:02:34', null, '1', '', '16', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:04:58', null, '1', '', '17', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:08:02', null, '1', '', '18', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 09:12:48', null, '1', '', '19', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 13:23:46', null, '1', 'prueba de gustavo', '20', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 13:31:47', null, '1', '', '21', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:19:44', null, '1', '', '22', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:20:46', null, '1', '', '23', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:37:49', null, '1', '', '24', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:48:40', null, '1', '', '25', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 14:49:53', null, '1', '', '26', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:00:50', null, '1', '', '27', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:01:37', null, '1', '', '28', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:02:04', null, '1', '', '29', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:03:07', null, '1', '', '30', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:11:21', null, '1', '', '31', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 15:57:13', null, '1', '', '32', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 16:42:44', null, '1', '', '33', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-20 16:48:49', null, '1', '', '34', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:12:02', null, '1', '', '35', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:22:22', null, '1', '', '36', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:24:56', null, '1', '', '37', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:28:36', null, '1', '', '38', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-21 16:30:09', null, '1', '', '39', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-22 16:24:56', null, '1', '', '40', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-22 16:32:37', null, '1', '', '41', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-01-22 16:45:47', null, '1', '', '42', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-02-04 09:47:56', null, '1', 'jugjhjghjghjghjghjghj', '43', '0');
INSERT INTO `ospos_receivings` VALUES ('2014-03-05 16:12:20', null, '1', '', '44', '0');

-- ----------------------------
-- Table structure for `ospos_receivings_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_receivings_items`;
CREATE TABLE `ospos_receivings_items` (
  `receiving_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL,
  `quantity_purchased` int(10) NOT NULL DEFAULT '0',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` double(15,2) NOT NULL,
  `discount_percent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`receiving_id`,`item_id`,`line`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_receivings_items
-- ----------------------------
INSERT INTO `ospos_receivings_items` VALUES ('1', '93', '', '', '1', '1', '15.00', '15.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('2', '98', '', '', '1', '1', '1200.00', '1200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('2', '71', '', '', '2', '1', '0.00', '0.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('2', '8', '', '', '3', '1', '0.00', '0.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('3', '107', '', '', '1', '1', '1200.00', '1200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('4', '107', '', '', '1', '1', '1200.00', '1200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('5', '98', '', '0', '1', '20', '1200.00', '1200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('6', '62', '', '', '1', '1', '0.00', '50.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('6', '99', '', '', '2', '20', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '99', '', '', '3', '22', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '100', '', '', '4', '7', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '101', '', '', '5', '12', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '102', '', '', '6', '23', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('7', '103', '', '', '7', '78', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '99', '', '', '3', '22', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '100', '', '', '4', '7', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '101', '', '', '5', '12', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '102', '', '', '6', '23', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('8', '103', '', '', '7', '78', '1200.00', '800.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('9', '111', '', '', '1', '1', '1200.00', '1200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('9', '112', '', '', '2', '1', '1200.00', '1200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('10', '104', '', '', '1', '2', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('10', '105', '', '', '2', '4', '1200.00', '200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('10', '106', '', '', '3', '6', '1200.00', '224.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('11', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('12', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('13', '104', '', '', '1', '2', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('13', '105', '', '', '2', '4', '1200.00', '200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('13', '106', '', '', '3', '6', '1200.00', '224.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('14', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('15', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('16', '104', '', '', '1', '2', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('16', '105', '', '', '2', '4', '1200.00', '200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('16', '106', '', '', '3', '6', '1200.00', '224.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('17', '1', '', '', '1', '20', '13.00', '30.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('17', '20', '', '', '2', '5', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('17', '82', '', '', '3', '1', '0.00', '75.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('18', '1', '', '', '1', '20', '13.00', '30.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('18', '20', '', '', '2', '5', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('18', '82', '', '', '3', '1', '0.00', '75.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '99', '', '', '3', '22', '1200.00', '400.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '100', '', '', '4', '7', '1200.00', '256.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '101', '', '', '5', '12', '1200.00', '125.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '102', '', '', '6', '23', '1200.00', '80.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('19', '103', '', '', '7', '78', '1200.00', '66.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('20', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('21', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('22', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('23', '104', '', '', '1', '2', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('23', '105', '', '', '2', '4', '1200.00', '200.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('23', '106', '', '', '3', '6', '1200.00', '224.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('24', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('25', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('26', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('27', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('28', '108', '', '', '1', '1', '1200.00', '69.50', '0');
INSERT INTO `ospos_receivings_items` VALUES ('29', '108', '', '', '1', '1', '1200.00', '69.50', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '99', '', '', '3', '22', '1200.00', '400.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '100', '', '', '4', '7', '1200.00', '256.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '101', '', '', '5', '12', '1200.00', '125.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '102', '', '', '6', '23', '1200.00', '80.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('30', '103', '', '', '7', '78', '1200.00', '66.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('31', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '99', '', '', '3', '22', '1200.00', '400.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '100', '', '', '4', '7', '1200.00', '256.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '101', '', '', '5', '12', '1200.00', '125.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '102', '', '', '6', '23', '1200.00', '80.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('32', '103', '', '', '7', '78', '1200.00', '66.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('33', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('34', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('35', '108', '', '', '1', '1', '1200.00', '69.50', '0');
INSERT INTO `ospos_receivings_items` VALUES ('36', '108', '', '', '1', '1', '1200.00', '69.50', '0');
INSERT INTO `ospos_receivings_items` VALUES ('37', '108', '', '', '1', '1', '1200.00', '69.50', '0');
INSERT INTO `ospos_receivings_items` VALUES ('38', '1', '', '', '1', '20', '13.00', '30.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('38', '20', '', '', '2', '5', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('38', '82', '', '', '3', '1', '0.00', '75.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('39', '1', '', '', '1', '20', '13.00', '30.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('39', '20', '', '', '2', '5', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('39', '82', '', '', '3', '1', '0.00', '75.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('40', '108', '', '', '1', '1', '1200.00', '69.50', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '99', '', '', '3', '22', '1200.00', '400.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '100', '', '', '4', '7', '1200.00', '256.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '101', '', '', '5', '12', '1200.00', '125.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '102', '', '', '6', '23', '1200.00', '80.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('41', '103', '', '', '7', '78', '1200.00', '66.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '20', '', '', '1', '17', '0.00', '79.95', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '71', '', '', '2', '4', '0.00', '45.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '99', '', '', '3', '22', '1200.00', '400.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '100', '', '', '4', '7', '1200.00', '256.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '101', '', '', '5', '12', '1200.00', '125.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '102', '', '', '6', '23', '1200.00', '80.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('42', '103', '', '', '7', '78', '1200.00', '66.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('43', '104', '', '', '1', '8', '1200.00', '593.00', '0');
INSERT INTO `ospos_receivings_items` VALUES ('44', '106', '', '', '1', '2', '1200.00', '224.00', '0');

-- ----------------------------
-- Table structure for `ospos_sales`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales`;
CREATE TABLE `ospos_sales` (
  `sale_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `sale_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(512) DEFAULT NULL,
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sale_id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales
-- ----------------------------
INSERT INTO `ospos_sales` VALUES ('2014-01-29 07:29:15', null, '1', '0', '1', 'Cash: $25.00<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-01-29 07:33:44', null, '1', '0', '2', 'Cash: $448.00<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-01-29 07:51:40', '2', '1', '0', '3', 'Cash: $50.00<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-01-29 07:53:02', '2', '1', '0', '4', 'Cash: $765.80<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-01-29 07:55:45', '2', '1', '0', '5', 'Cash: $400.00<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-01-29 08:43:02', '2', '1', '0', '6', 'Cash: $448.00<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-01-29 08:44:01', null, '1', '0', '7', 'Cash: $433.46<br />', '0', '1');
INSERT INTO `ospos_sales` VALUES ('2014-02-04 08:08:37', '3', '1', '0', '8', 'Check: $1000.00<br />Debit Card: $2330.98<br />Cash: $1550.00<br />', '0', '1');
INSERT INTO `ospos_sales` VALUES ('2014-02-04 08:13:34', '2', '1', '0', '9', 'Cash: $48.15<br />', '2', '1');
INSERT INTO `ospos_sales` VALUES ('2014-02-06 07:47:26', '2', '1', '0', '10', 'Cash: $399.87<br />', '2', '1');

-- ----------------------------
-- Table structure for `ospos_sales_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_items`;
CREATE TABLE `ospos_sales_items` (
  `sale_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `quantity_purchased` double(15,2) NOT NULL DEFAULT '0.00',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` double(15,2) NOT NULL,
  `discount_percent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sale_id`,`item_id`,`line`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_items
-- ----------------------------
INSERT INTO `ospos_sales_items` VALUES ('1', '85', '', '', '1', '1.00', '0.00', '25.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('2', '106', '', '', '1', '2.00', '1200.00', '224.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('3', '58', '', '', '1', '1.00', '0.00', '50.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('4', '106', '', '', '1', '2.00', '1200.00', '224.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('4', '109', '', '', '2', '2.00', '1200.00', '80.90', '0');
INSERT INTO `ospos_sales_items` VALUES ('4', '111', '', '', '3', '1.00', '1200.00', '156.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('5', '105', '', '', '1', '2.00', '1200.00', '200.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('6', '106', '', '', '1', '2.00', '1200.00', '224.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('7', '110', '', '', '1', '2.00', '1200.00', '200.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('8', '106', '', '', '1', '6.00', '1200.00', '300.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('8', '109', '', '', '2', '18.00', '1200.00', '80.90', '0');
INSERT INTO `ospos_sales_items` VALUES ('8', '111', '', '', '3', '8.00', '1200.00', '156.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('9', '9', '', '', '1', '1.00', '0.00', '45.00', '0');
INSERT INTO `ospos_sales_items` VALUES ('10', '98', '', '', '1', '1.00', '1200.00', '369.00', '0');

-- ----------------------------
-- Table structure for `ospos_sales_items_taxes`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_items_taxes`;
CREATE TABLE `ospos_sales_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `percent` double(15,3) NOT NULL,
  PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_items_taxes
-- ----------------------------
INSERT INTO `ospos_sales_items_taxes` VALUES ('7', '110', '1', 'Sales Tax', '8.365');
INSERT INTO `ospos_sales_items_taxes` VALUES ('8', '106', '1', 'Sales Tax', '8.365');
INSERT INTO `ospos_sales_items_taxes` VALUES ('8', '109', '2', 'Sales Tax', '8.365');
INSERT INTO `ospos_sales_items_taxes` VALUES ('8', '111', '3', 'Sales Tax', '8.365');

-- ----------------------------
-- Table structure for `ospos_sales_payments`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_payments`;
CREATE TABLE `ospos_sales_payments` (
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  PRIMARY KEY (`sale_id`,`payment_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_payments
-- ----------------------------
INSERT INTO `ospos_sales_payments` VALUES ('1', 'Cash', '25.00');
INSERT INTO `ospos_sales_payments` VALUES ('2', 'Cash', '448.00');
INSERT INTO `ospos_sales_payments` VALUES ('3', 'Cash', '50.00');
INSERT INTO `ospos_sales_payments` VALUES ('4', 'Cash', '765.80');
INSERT INTO `ospos_sales_payments` VALUES ('5', 'Cash', '400.00');
INSERT INTO `ospos_sales_payments` VALUES ('6', 'Cash', '448.00');
INSERT INTO `ospos_sales_payments` VALUES ('7', 'Cash', '433.46');
INSERT INTO `ospos_sales_payments` VALUES ('8', 'Check', '1000.00');
INSERT INTO `ospos_sales_payments` VALUES ('8', 'Debit Card', '2330.98');
INSERT INTO `ospos_sales_payments` VALUES ('8', 'Cash', '1550.00');
INSERT INTO `ospos_sales_payments` VALUES ('9', 'Cash', '48.15');
INSERT INTO `ospos_sales_payments` VALUES ('10', 'Cash', '399.87');

-- ----------------------------
-- Table structure for `ospos_sales_suspended`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_suspended`;
CREATE TABLE `ospos_sales_suspended` (
  `sale_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `sale_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_suspended
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_sales_suspended_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_suspended_items`;
CREATE TABLE `ospos_sales_suspended_items` (
  `sale_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `quantity_purchased` double(15,2) NOT NULL DEFAULT '0.00',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` double(15,2) NOT NULL,
  `discount_percent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sale_id`,`item_id`,`line`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_suspended_items
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_sales_suspended_items_taxes`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_suspended_items_taxes`;
CREATE TABLE `ospos_sales_suspended_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `percent` double(15,3) NOT NULL,
  PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_suspended_items_taxes
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_sales_suspended_payments`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sales_suspended_payments`;
CREATE TABLE `ospos_sales_suspended_payments` (
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  PRIMARY KEY (`sale_id`,`payment_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales_suspended_payments
-- ----------------------------

-- ----------------------------
-- Table structure for `ospos_schedules`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_schedules`;
CREATE TABLE `ospos_schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(11) NOT NULL,
  `in` time NOT NULL,
  `out` time NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ospos_schedules
-- ----------------------------
INSERT INTO `ospos_schedules` VALUES ('155', 'Friday', '08:00:00', '17:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('154', 'Thursday', '00:00:00', '19:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('153', 'Wednesday', '00:00:00', '16:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('152', 'Tuesday', '00:00:00', '20:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('151', 'Monday', '00:00:00', '21:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('150', 'Sunday', '00:00:00', '23:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('156', 'Saturday', '00:00:00', '01:00:00', '1');
INSERT INTO `ospos_schedules` VALUES ('157', 'Sunday', '08:00:00', '19:00:00', '4');
INSERT INTO `ospos_schedules` VALUES ('158', 'Monday', '08:00:00', '18:00:00', '4');
INSERT INTO `ospos_schedules` VALUES ('159', 'Tuesday', '08:00:00', '16:00:00', '4');
INSERT INTO `ospos_schedules` VALUES ('160', 'Wednesday', '08:00:00', '16:00:00', '4');
INSERT INTO `ospos_schedules` VALUES ('161', 'Thursday', '08:00:00', '16:00:00', '4');

-- ----------------------------
-- Table structure for `ospos_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_sessions`;
CREATE TABLE `ospos_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sessions
-- ----------------------------
INSERT INTO `ospos_sessions` VALUES ('40b84f2bbbf696bf459aa92f1477b407', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36', '1394571812', 'a:10:{s:9:\"user_data\";s:0:\"\";s:9:\"person_id\";s:1:\"1\";s:6:\"taxing\";s:1:\"1\";s:9:\"recv_mode\";s:7:\"receive\";s:8:\"supplier\";i:-1;s:8:\"employee\";i:-1;s:4:\"cart\";a:0:{}s:9:\"sale_mode\";s:4:\"sale\";s:8:\"customer\";i:-1;s:8:\"payments\";a:0:{}}');
INSERT INTO `ospos_sessions` VALUES ('38842dfb878da9889e86d103b077461b', '192.168.1.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36', '1394554026', 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"person_id\";s:1:\"1\";}');

-- ----------------------------
-- Table structure for `ospos_suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_suppliers`;
CREATE TABLE `ospos_suppliers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `account_number` (`account_number`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_suppliers
-- ----------------------------
INSERT INTO `ospos_suppliers` VALUES ('90', 'Ramon Tech', null, '0');
INSERT INTO `ospos_suppliers` VALUES ('91', 'Ramon Tech', null, '1');
INSERT INTO `ospos_suppliers` VALUES ('92', 'Ramon & Supplies', null, '0');

-- ----------------------------
-- Table structure for `ospos_transfers`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_transfers`;
CREATE TABLE `ospos_transfers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_transfers
-- ----------------------------
INSERT INTO `ospos_transfers` VALUES ('1', 'default', 'other', '2013-12-13', '1');
INSERT INTO `ospos_transfers` VALUES ('2', 'default', 'other', '2013-12-13', '1');
INSERT INTO `ospos_transfers` VALUES ('3', 'default', 'other', '2013-12-13', '1');
INSERT INTO `ospos_transfers` VALUES ('4', 'default', 'other', '2013-12-13', '1');
INSERT INTO `ospos_transfers` VALUES ('5', 'default', 'other', '2014-01-13', '1');
INSERT INTO `ospos_transfers` VALUES ('6', 'default', 'default', '2014-01-15', '0');
INSERT INTO `ospos_transfers` VALUES ('7', 'default', 'other', '2014-01-15', '0');
INSERT INTO `ospos_transfers` VALUES ('8', 'default', 'other', '2014-01-16', '1');
INSERT INTO `ospos_transfers` VALUES ('9', 'default', 'other', '2014-01-20', '1');
INSERT INTO `ospos_transfers` VALUES ('10', 'default', 'other', '2014-01-20', '1');
INSERT INTO `ospos_transfers` VALUES ('11', 'default', 'other', '2014-01-22', '1');
INSERT INTO `ospos_transfers` VALUES ('12', 'default', 'other', '2014-01-22', '1');

-- ----------------------------
-- Table structure for `ospos_transfer_items`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_transfer_items`;
CREATE TABLE `ospos_transfer_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_transfer_items
-- ----------------------------
INSERT INTO `ospos_transfer_items` VALUES ('1', '1', '20', '17');
INSERT INTO `ospos_transfer_items` VALUES ('2', '1', '71', '4');
INSERT INTO `ospos_transfer_items` VALUES ('3', '1', '99', '22');
INSERT INTO `ospos_transfer_items` VALUES ('4', '1', '100', '7');
INSERT INTO `ospos_transfer_items` VALUES ('5', '1', '101', '12');
INSERT INTO `ospos_transfer_items` VALUES ('6', '1', '102', '23');
INSERT INTO `ospos_transfer_items` VALUES ('7', '1', '103', '78');
INSERT INTO `ospos_transfer_items` VALUES ('8', '2', '62', '1');
INSERT INTO `ospos_transfer_items` VALUES ('9', '2', '99', '20');
INSERT INTO `ospos_transfer_items` VALUES ('10', '3', '84', '1');
INSERT INTO `ospos_transfer_items` VALUES ('11', '3', '104', '1');
INSERT INTO `ospos_transfer_items` VALUES ('12', '4', '1', '20');
INSERT INTO `ospos_transfer_items` VALUES ('13', '4', '20', '5');
INSERT INTO `ospos_transfer_items` VALUES ('14', '4', '82', '1');
INSERT INTO `ospos_transfer_items` VALUES ('15', '5', '108', '1');
INSERT INTO `ospos_transfer_items` VALUES ('16', '6', '104', '2');
INSERT INTO `ospos_transfer_items` VALUES ('17', '6', '105', '4');
INSERT INTO `ospos_transfer_items` VALUES ('18', '6', '106', '6');
INSERT INTO `ospos_transfer_items` VALUES ('19', '7', '104', '8');
INSERT INTO `ospos_transfer_items` VALUES ('20', '8', '43', '6');
INSERT INTO `ospos_transfer_items` VALUES ('21', '9', '4', '4');
INSERT INTO `ospos_transfer_items` VALUES ('22', '9', '43', '4');
INSERT INTO `ospos_transfer_items` VALUES ('23', '9', '55', '10');
INSERT INTO `ospos_transfer_items` VALUES ('24', '9', '58', '5');
INSERT INTO `ospos_transfer_items` VALUES ('25', '9', '68', '8');
INSERT INTO `ospos_transfer_items` VALUES ('26', '10', '108', '1');
INSERT INTO `ospos_transfer_items` VALUES ('27', '10', '111', '1');
INSERT INTO `ospos_transfer_items` VALUES ('28', '10', '112', '1');
INSERT INTO `ospos_transfer_items` VALUES ('29', '11', '109', '1');
INSERT INTO `ospos_transfer_items` VALUES ('30', '11', '110', '7');
INSERT INTO `ospos_transfer_items` VALUES ('31', '12', '2', '1');
INSERT INTO `ospos_transfer_items` VALUES ('32', '12', '50', '1');
