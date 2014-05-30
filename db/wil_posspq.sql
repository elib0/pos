/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : posspq

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-05-30 17:07:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `chat`
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of chat
-- ----------------------------

-- ----------------------------
-- Table structure for `ci_users`
-- ----------------------------
DROP TABLE IF EXISTS `ci_users`;
CREATE TABLE `ci_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `registered_date` datetime NOT NULL,
  `status` int(5) NOT NULL,
  `online` int(5) NOT NULL,
  PRIMARY KEY (`user_id`,`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_users
-- ----------------------------

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
INSERT INTO `ospos_app_config` VALUES ('address', '0');
INSERT INTO `ospos_app_config` VALUES ('company', 'Fast I Repair');
INSERT INTO `ospos_app_config` VALUES ('default_tax_rate', '8');
INSERT INTO `ospos_app_config` VALUES ('email', 'info@smokefreevapor.net');
INSERT INTO `ospos_app_config` VALUES ('fax', '');
INSERT INTO `ospos_app_config` VALUES ('phone', '405-603-3599');
INSERT INTO `ospos_app_config` VALUES ('return_policy', 'All Sales Final\r\n');
INSERT INTO `ospos_app_config` VALUES ('timezone', 'America/Caracas');
INSERT INTO `ospos_app_config` VALUES ('website', 'www.smokefreevapor.net');
INSERT INTO `ospos_app_config` VALUES ('default_tax_1_rate', '8.365');
INSERT INTO `ospos_app_config` VALUES ('default_tax_1_name', 'Sales Tax');
INSERT INTO `ospos_app_config` VALUES ('default_tax_2_rate', '');
INSERT INTO `ospos_app_config` VALUES ('default_tax_2_name', '');
INSERT INTO `ospos_app_config` VALUES ('currency_symbol', '$');
INSERT INTO `ospos_app_config` VALUES ('language', 'english');
INSERT INTO `ospos_app_config` VALUES ('print_after_sale', 'print_after_sale');
INSERT INTO `ospos_app_config` VALUES ('logo', '1011033_1389775584632955_2043319677_n.jpg');
INSERT INTO `ospos_app_config` VALUES ('alert_after_sale', 'alert_after_sale');

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
  `type_employees` varchar(20) DEFAULT NULL,
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_employees
-- ----------------------------
INSERT INTO `ospos_employees` VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', '1', '1', '0', '0', 'administrator');

-- ----------------------------
-- Table structure for `ospos_employees_profile`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_employees_profile`;
CREATE TABLE `ospos_employees_profile` (
  `profile_name` varchar(50) DEFAULT NULL,
  `module_id` varchar(255) DEFAULT NULL,
  `privileges` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_employees_profile
-- ----------------------------
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'customers', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'items', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'item_kits', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'suppliers', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'receivings', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'sales', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'employees', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'giftcards', 'add,delete');
INSERT INTO `ospos_employees_profile` VALUES ('prueba de emergencia', 'config', 'save');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'customers', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'items', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'item_kits', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'suppliers', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'reports', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'receivings', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'sales', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'employees', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'giftcards', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'locations', 'add,update,disable');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'config', 'save');

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
) ENGINE=InnoDB AUTO_INCREMENT=254 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_employees_schedule
-- ----------------------------
INSERT INTO `ospos_employees_schedule` VALUES ('1', '1', '2014-02-01', '08:00:00', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('2', '1', '2014-02-02', '08:20:00', '16:34:07', 'other');
INSERT INTO `ospos_employees_schedule` VALUES ('3', '1', '2014-02-03', '08:15:50', '16:34:07', 'other');
INSERT INTO `ospos_employees_schedule` VALUES ('4', '1', '2014-02-04', '08:19:20', '16:34:07', 'other');
INSERT INTO `ospos_employees_schedule` VALUES ('5', '1', '2014-02-05', '08:00:00', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('6', '1', '2014-02-06', '08:00:00', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('8', '1', '2014-02-08', '09:13:13', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('9', '1', '2014-02-09', '13:31:23', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('180', '1', '2014-03-05', '09:50:30', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('181', '1', '2014-03-05', '09:51:00', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('182', '1', '2014-03-05', '09:51:08', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('183', '1', '2014-03-05', '10:01:31', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('184', '1', '2014-03-05', '10:03:49', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('185', '1', '2014-03-05', '10:10:28', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('194', '1', '2014-04-21', '09:37:05', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('195', '1', '2014-04-21', '09:43:17', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('204', '1', '2014-04-28', '09:09:01', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('206', '1', '2014-04-29', '09:35:17', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('208', '1', '2014-04-30', '11:29:06', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('209', '1', '2014-04-30', '15:12:26', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('219', '1', '2014-05-22', '14:14:18', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('220', '1', '2014-05-22', '14:14:47', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('221', '1', '2014-05-22', '14:15:21', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('222', '1', '2014-05-22', '14:29:02', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('228', '1', '2014-05-26', '09:42:18', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('229', '1', '2014-05-26', '10:59:53', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('232', '1', '2014-05-28', '10:51:44', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('234', '1', '2014-05-28', '17:16:45', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('236', '1', '2014-05-29', '12:04:19', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('238', '1', '2014-05-29', '14:58:14', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('239', '1', '2014-05-29', '15:04:12', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('241', '1', '2014-05-30', '10:12:23', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('243', '1', '2014-05-30', '11:45:16', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('244', '1', '2014-05-30', '11:56:17', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('249', '1', '2014-05-30', '16:05:32', '16:34:07', 'default');
INSERT INTO `ospos_employees_schedule` VALUES ('250', '1', '2014-05-30', '16:11:00', '16:34:07', 'default');

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
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=517 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_inventory
-- ----------------------------

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
  `is_service` tinyint(1) NOT NULL,
  `is_locked` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `broken_quantity` int(15) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_number` (`item_number`),
  KEY `ospos_items_ibfk_1` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_items
-- ----------------------------
INSERT INTO `ospos_items` VALUES ('Iphone 3G Digitizer', 'Digitizers', null, '123456', '', '13.00', '30.00', '0.00', '20.00', '', '1', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Iphone 3G LCD', 'LCDs', null, null, '', '20.00', '35.00', '0.00', '10.00', '', '2', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Repair Service', 'Services', null, null, '', '30.00', '30.00', '0.00', '1.00', '0', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Digitizer', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '3.00', '', '4', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Screen Protector', 'Accessories', null, null, '', '0.00', '10.00', '0.00', '10.00', '', '5', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('LifeProof Case', 'Accessories', null, null, '', '0.00', '85.00', '0.00', '5.00', '', '6', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad Protect Case', 'Accessories', null, null, '', '0.00', '49.99', '0.00', '2.00', '', '7', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Iphone 3gs Back', 'Accessories', null, null, '', '0.00', '75.00', '0.00', '0.00', '', '8', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3G Digitizer (1)', 'iPhone', null, '01020304', '', '0.00', '45.00', '0.00', '2.00', '', '9', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 2 Screen Black', 'Ipad', null, null, '', '0.00', '125.00', '0.00', '1.00', '', '10', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 2 Screen White ', 'Ipad', null, null, '', '0.00', '125.00', '0.00', '1.00', '', '11', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 3 Screen White', 'Ipad', null, null, '', '0.00', '200.00', '0.00', '0.00', '', '12', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Ipad 3 Screen Black', 'Ipad', null, null, '', '0.00', '200.00', '0.00', '0.00', '', '13', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Back White', 'iPhone', null, null, '', '0.00', '30.00', '0.00', '2.00', '', '14', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Back Black', 'iPhone', null, null, '', '0.00', '30.00', '0.00', '2.00', '', '15', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Back white', 'iPhone', null, null, '', '0.00', '30.00', '0.00', '2.00', '', '16', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s Back Black', 'iPhone', null, null, '', '0.00', '30.00', '0.00', '2.00', '', '17', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Black Screen', 'iPhone', null, null, '', '0.00', '79.95', '0.00', '3.00', '', '18', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM White Screen', 'iPhone', null, null, '', '0.00', '79.95', '0.00', '3.00', '', '19', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA White screen', 'iPhone', null, null, '', '0.00', '79.95', '0.00', '2.00', '', '20', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Black Screen', 'iPhone', null, null, '', '0.00', '79.95', '0.00', '2.00', '', '21', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s white Screen', 'iPhone', null, null, '', '0.00', '89.95', '0.00', '3.00', '', '22', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s Black screen', 'iPhone', null, null, '', '0.00', '89.95', '0.00', '3.00', '', '23', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3gs lcd', 'iPhone', null, null, '', '0.00', '65.00', '0.00', '1.00', '', '24', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color set Pink', 'iPhone', null, null, '', '0.00', '120.00', '0.00', '1.00', '', '25', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM color set pink', 'iPhone', null, null, '', '0.00', '110.00', '0.00', '1.00', '', '26', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color set Red', 'iPhone', null, null, '', '0.00', '120.00', '0.00', '0.00', '', '27', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM color set red', 'iPhone', null, null, '', '0.00', '110.00', '0.00', '0.00', '', '28', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 gsm color front', 'iPhone', null, null, '', '0.00', '89.95', '0.00', '1.00', '', '29', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 gsm color back', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '1.00', '', '30', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color front screen', 'iPhone', null, null, '', '0.00', '95.00', '0.00', '2.00', '', '31', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4s color back', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '2.00', '', '32', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA color front screen', 'iPhone', null, null, '', '0.00', '89.95', '0.00', '0.00', '', '33', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA color backs', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '0.00', '', '34', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA color backs', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '0.00', '', '35', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Repair', 'iPhone', null, null, '', '0.00', '0.00', '0.00', '0.00', '', '36', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Black Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '37', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM White Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '38', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA White Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '39', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Black Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '40', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Black Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '41', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S White Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '42', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('iPad 2 Home Button', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '2.00', '', '43', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS LCD', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '0.00', '', '44', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3G Digitizer', 'iPhone', null, '010203', '', '0.00', '45.00', '0.00', '2.00', '', '45', '0', '1', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM White Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '46', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Black Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '47', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S White Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '48', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Black Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '49', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Back Assembly', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '0.00', '', '50', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 Home Flex', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '2.00', '', '51', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Vibrator', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '1.00', '', '52', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Audio Jack', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '1.00', '', '53', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Power Flex', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '2.00', '', '54', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Digitizer', 'ipad', null, null, '', '0.00', '100.00', '0.00', '0.00', '', '55', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 Back Camera', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '1.00', '', '56', '1', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Front Camera', 'iPhone', null, null, '', '0.00', '40.00', '0.00', '1.00', '', '57', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Dock', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '1.00', '', '58', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Power Flex', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '2.00', '', '59', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Home Flex', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '2.00', '', '60', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Home Flex', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '61', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('CDMA Audio Jack', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '2.00', '', '62', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('iPad 2 Power Flex', 'ipad', null, null, '', '0.00', '100.00', '0.00', '0.00', '', '63', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Power Flex', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '1.00', '', '64', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3GS Battery', 'iPhone', null, null, '', '555.00', '40666.00', '0.00', '1.00', '', '65', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4G Battery', 'iPhone', null, null, '', '0.00', '40.00', '0.00', '2.00', '', '66', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Battery', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '1.00', '', '67', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA / 4S Vibrator', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '0.00', '', '68', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('3G Dock', 'iPhone', null, null, '', '0.00', '35.00', '0.00', '0.00', '', '69', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Boom Box', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '0.00', '', '70', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('CDMA / 4S Boom Box', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '1.00', '', '71', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Audio Jack', 'iPhone', null, null, '', '0.00', '50.00', '0.00', '0.00', '', '72', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Charging Dock', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '2.00', '', '73', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('CDMA Dock Assembly', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '2.00', '', '74', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Charging Dock', 'iPhone', null, null, '', '0.00', '45.00', '0.00', '2.00', '', '75', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Life Proof Case', 'Accessories', null, null, '', '59.00', '89.99', '0.00', '5.00', '', '76', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('iPad Case', 'Accessories', null, null, '', '0.00', '49.99', '0.00', '2.00', '', '77', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('OtterBox Case', 'Accessories', null, null, '', '0.00', '49.99', '0.00', '2.00', '', '78', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Screen Protector', 'Accessories', null, null, '', '0.00', '10.00', '0.00', '20.00', '', '79', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Color Front', 'iPhone', null, null, '', '0.00', '85.00', '0.00', '2.00', '', '80', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4S Color Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '81', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Color Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '82', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 GSM Color Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '83', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Color Front', 'iPhone', null, null, '', '0.00', '75.00', '0.00', '2.00', '', '84', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('4 CDMA Color Back', 'iPhone', null, null, '', '0.00', '25.00', '0.00', '2.00', '', '85', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('itouch 4 Black Front', 'ipod', null, null, '', '0.00', '85.00', '0.00', '2.00', '', '86', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('itouch 4 White Front', 'ipod', null, null, '', '0.00', '85.00', '0.00', '2.00', '', '87', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Unlock Service', 'Repair', null, null, '', '0.00', '60.00', '0.00', '0.00', '', '88', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Repair Service', 'Repair', null, null, '', '0.00', '0.00', '0.00', '0.00', '', '89', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Data Cable', 'Accessories', null, null, '', '0.00', '10.00', '0.00', '0.00', '', '90', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('HTC EVO Assembly', 'HTC', null, null, '', '0.00', '105.00', '0.00', '1.00', '', '91', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Mytouch 4G Front Assembly', 'HTC', null, null, '', '0.00', '100.00', '0.00', '1.00', '', '92', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Mytouch 3G Slide', 'Phone', null, null, '', '15.00', '0.00', '0.00', '0.00', '', '93', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Battery Back Case', 'Accessories', null, null, '', '0.00', '0.00', '0.00', '1.00', '', '94', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Phone Case', 'Accessories', null, null, '', '0.00', '25.00', '0.00', '5.00', '', '95', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('culo', 'iPhone', null, null, '', '200.00', '100.00', '0.00', '2.00', '', '96', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('tiger blood', 'smoke', null, 'UEN', 'bdghkaghdagkasg', '30.00', '10.00', '0.00', '5.00', 'where', '97', '1', '1', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 1', 'Blackberry', null, null, '', '1200.00', '369.00', '0.00', '10.00', '', '98', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 2', 'Blackberry', null, null, '', '1200.00', '400.00', '0.00', '10.00', '', '99', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 4', 'Blackberry', null, null, '', '1200.00', '256.00', '0.00', '10.00', '', '100', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 5', 'Blackberry', null, null, '', '1200.00', '125.00', '0.00', '10.00', '', '101', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 6', 'Blackberry', null, null, '', '1200.00', '80.00', '0.00', '10.00', '', '102', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 7', 'Blackberry', null, null, '', '1200.00', '66.00', '0.00', '10.00', '', '103', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 8', 'Blackberry', null, null, '', '1200.00', '593.00', '0.00', '10.00', '', '104', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 9', 'Blackberry', null, null, '', '1200.00', '200.00', '0.00', '10.00', '', '105', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 10', 'Blackberry', null, null, '', '1200.00', '224.00', '0.00', '10.00', '', '106', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 11', 'Blackberry', null, null, '', '1200.00', '37.00', '0.00', '10.00', '', '107', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 12', 'Blackberry', null, null, '', '1200.00', '69.50', '0.00', '10.00', '', '108', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 13', 'Blackberry', null, null, '', '1200.00', '80.90', '0.00', '10.00', '', '109', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 14', 'Blackberry', null, null, '', '1200.00', '200.00', '0.00', '10.00', '', '110', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 15', 'Blackberry', null, null, '', '1200.00', '156.00', '0.00', '10.00', '', '111', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Pantalla bold 16', 'Blackberry', null, null, '', '1200.00', '187.00', '0.00', '10.00', '', '112', '0', '0', '0', '0', '0', '0');
INSERT INTO `ospos_items` VALUES ('Gift Card', 'Services', null, null, '', '0.00', '0.00', '0.00', '0.00', '0', '-1', '0', '0', '1', '1', '0', '0');
INSERT INTO `ospos_items` VALUES ('willem', 'Accessories', null, null, '', '20.00', '40.00', '0.00', '0.00', '0', '132', '0', '0', '1', '1', '0', '0');
INSERT INTO `ospos_items` VALUES ('wffranco', 'xxx', null, null, '', '1.00', '1.00', '0.00', '0.00', '0', '133', '0', '0', '0', '0', '0', '0');

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
INSERT INTO `ospos_items_taxes` VALUES ('131', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('132', 'Sales Tax', '8.365');
INSERT INTO `ospos_items_taxes` VALUES ('133', 'Sales Tax', '8.365');

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
INSERT INTO `ospos_modules` VALUES ('module_locations', 'module_locations_desc', '95', 'locations', 'add,update,disable');

-- ----------------------------
-- Table structure for `ospos_observation_inventories`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_observation_inventories`;
CREATE TABLE `ospos_observation_inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_register` timestamp NULL DEFAULT NULL,
  `observation` mediumtext,
  `person_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_observation_inventories
-- ----------------------------
INSERT INTO `ospos_observation_inventories` VALUES ('23', '2014-05-30 16:40:49', '', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_people
-- ----------------------------
INSERT INTO `ospos_people` VALUES ('Alex', 'Kundalia', '55555555555', 'info@om-parts.com', 'Address 1', '', '', '', '', 'wfranco', '', '1');

-- ----------------------------
-- Table structure for `ospos_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_permissions`;
CREATE TABLE `ospos_permissions` (
  `module_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `privileges` varchar(100) DEFAULT 'none',
  PRIMARY KEY (`module_id`,`person_id`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_permissions
-- ----------------------------
INSERT INTO `ospos_permissions` VALUES ('sales', '1', 'none');
INSERT INTO `ospos_permissions` VALUES ('receivings', '1', 'none');
INSERT INTO `ospos_permissions` VALUES ('reports', '1', 'none');
INSERT INTO `ospos_permissions` VALUES ('suppliers', '1', 'add,update,delete');
INSERT INTO `ospos_permissions` VALUES ('item_kits', '1', 'add,update,delete');
INSERT INTO `ospos_permissions` VALUES ('items', '1', 'add,update,delete');
INSERT INTO `ospos_permissions` VALUES ('customers', '1', 'add,update,delete');
INSERT INTO `ospos_permissions` VALUES ('employees', '1', 'add,update,delete');
INSERT INTO `ospos_permissions` VALUES ('giftcards', '1', 'add,update,delete');
INSERT INTO `ospos_permissions` VALUES ('locations', '1', 'add,update,disable');
INSERT INTO `ospos_permissions` VALUES ('config', '1', 'save');

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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_sales
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ospos_schedules
-- ----------------------------

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

-- ----------------------------
-- View structure for `ospos_ci_users`
-- ----------------------------
DROP VIEW IF EXISTS `ospos_ci_users`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ospos_ci_users` AS select `ospos_employees`.`person_id` AS `user_id`,`ospos_employees`.`username` AS `user_name`,NULL AS `user_email`,`ospos_employees`.`password` AS `user_password`,NULL AS `registered_date`,1 AS `status`,1 AS `online` from `ospos_employees` ;
