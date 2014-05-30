/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : possp_transactions

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-05-30 09:15:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ospos_chat`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_chat`;
CREATE TABLE `ospos_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) unsigned NOT NULL,
  `to_id` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to_id`),
  KEY `from` (`from_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat
-- ----------------------------
INSERT INTO `ospos_chat` VALUES ('1', '2', '1', 'aaa', '0000-00-00 00:00:00', '1');
INSERT INTO `ospos_chat` VALUES ('2', '1', '2', 'bbb', '0000-00-00 00:00:00', '1');
INSERT INTO `ospos_chat` VALUES ('3', '2', '1', 'aaa', '2014-05-26 10:10:37', '1');
INSERT INTO `ospos_chat` VALUES ('4', '1', '2', 'aaa', '2014-05-26 10:12:58', '1');
INSERT INTO `ospos_chat` VALUES ('5', '1', '2', 'bbb', '2014-05-26 10:14:50', '1');
INSERT INTO `ospos_chat` VALUES ('6', '1', '2', '1', '2014-05-26 10:21:13', '1');
INSERT INTO `ospos_chat` VALUES ('7', '1', '2', '2', '2014-05-26 10:21:36', '1');
INSERT INTO `ospos_chat` VALUES ('8', '1', '2', '3', '2014-05-26 10:32:34', '1');
INSERT INTO `ospos_chat` VALUES ('9', '2', '1', '4', '2014-05-26 10:32:41', '1');
INSERT INTO `ospos_chat` VALUES ('10', '1', '2', '0', '2014-05-26 10:34:19', '1');
INSERT INTO `ospos_chat` VALUES ('11', '2', '1', '1', '2014-05-26 10:34:28', '1');
INSERT INTO `ospos_chat` VALUES ('12', '1', '2', 'a', '2014-05-26 10:37:53', '1');
INSERT INTO `ospos_chat` VALUES ('13', '2', '1', 'eu', '2014-05-26 11:17:07', '1');
INSERT INTO `ospos_chat` VALUES ('14', '1', '2', 'hola', '2014-05-26 11:17:43', '1');
INSERT INTO `ospos_chat` VALUES ('15', '2', '1', 'bello', '2014-05-26 11:17:53', '1');
INSERT INTO `ospos_chat` VALUES ('16', '1', '2', ':)', '2014-05-26 11:18:40', '1');
INSERT INTO `ospos_chat` VALUES ('17', '1', '2', '\'', '2014-05-26 11:19:49', '1');
INSERT INTO `ospos_chat` VALUES ('18', '1', '2', '\'\'', '2014-05-26 11:19:52', '1');
INSERT INTO `ospos_chat` VALUES ('19', '1', '2', '\'\'\'\'\'\'', '2014-05-26 11:19:54', '1');
INSERT INTO `ospos_chat` VALUES ('20', '1', '2', '\'\'\'\'\'\'', '2014-05-26 11:19:54', '1');
INSERT INTO `ospos_chat` VALUES ('21', '1', '2', '\'', '2014-05-26 11:19:56', '1');
INSERT INTO `ospos_chat` VALUES ('22', '5', '6', 'eu', '2014-05-29 14:38:04', '0');
INSERT INTO `ospos_chat` VALUES ('23', '5', '6', 'eu', '2014-05-29 14:42:35', '0');
INSERT INTO `ospos_chat` VALUES ('24', '5', '6', 'eu', '2014-05-29 14:51:50', '0');
INSERT INTO `ospos_chat` VALUES ('25', '5', '6', 'eu again', '2014-05-29 14:52:35', '0');
INSERT INTO `ospos_chat` VALUES ('26', '6', '5', 'hola guapo', '2014-05-29 14:58:30', '1');
INSERT INTO `ospos_chat` VALUES ('27', '6', '5', 'hola', '2014-05-29 15:04:21', '1');
INSERT INTO `ospos_chat` VALUES ('28', '6', '5', 'ppp', '2014-05-29 15:04:44', '1');

-- ----------------------------
-- Table structure for `ospos_chat_status`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_chat_status`;
CREATE TABLE `ospos_chat_status` (
  `id` tinyint(3) unsigned NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat_status
-- ----------------------------
INSERT INTO `ospos_chat_status` VALUES ('0', 'offline');
INSERT INTO `ospos_chat_status` VALUES ('1', 'online');
INSERT INTO `ospos_chat_status` VALUES ('2', 'iddle');
INSERT INTO `ospos_chat_status` VALUES ('3', 'eating');

-- ----------------------------
-- Table structure for `ospos_chat_users`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_chat_users`;
CREATE TABLE `ospos_chat_users` (
  `chat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `disabled` tinyint(4) NOT NULL,
  `last_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`),
  UNIQUE KEY `usr` (`user_id`,`location`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat_users
-- ----------------------------
INSERT INTO `ospos_chat_users` VALUES ('5', '43', 'default', 'wfranco', '0', '0', '2014-05-29 16:39:52');
INSERT INTO `ospos_chat_users` VALUES ('6', '1', 'default', 'admin', '0', '0', '2014-05-29 16:17:28');

-- ----------------------------
-- Table structure for `ospos_chat_user_typing`
-- ----------------------------
DROP TABLE IF EXISTS `ospos_chat_user_typing`;
CREATE TABLE `ospos_chat_user_typing` (
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `typing` bit(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`from_id`,`to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat_user_typing
-- ----------------------------
INSERT INTO `ospos_chat_user_typing` VALUES ('6', '5', '', '2014-05-29 15:09:51');

-- ----------------------------
-- View structure for `ospos_chat_users_view`
-- ----------------------------
DROP VIEW IF EXISTS `ospos_chat_users_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ospos_chat_users_view` AS select `ospos_chat_users`.`chat_id` AS `chat_id`,`ospos_chat_users`.`user_id` AS `user_id`,concat(`ospos_chat_users`.`username`,' (',`ospos_chat_users`.`location`,')') AS `user`,`ospos_chat_users`.`location` AS `location`,`ospos_chat_users`.`username` AS `username`,if(`ospos_chat_users`.`disabled`,0,`ospos_chat_users`.`status`) AS `status_id`,`ospos_chat_status`.`name` AS `status_name`,`ospos_chat_users`.`disabled` AS `disabled`,`ospos_chat_users`.`last_action` AS `last_action` from (`ospos_chat_users` join `ospos_chat_status`) where (if(`ospos_chat_users`.`disabled`,0,`ospos_chat_users`.`status`) = `ospos_chat_status`.`id`) ;

-- ----------------------------
-- View structure for `ospos_chat_view`
-- ----------------------------
DROP VIEW IF EXISTS `ospos_chat_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ospos_chat_view` AS select `ospos_chat`.`id` AS `id`,`ospos_chat`.`from_id` AS `from_id`,concat(`a`.`username`,' (',`a`.`location`,')') AS `from`,`ospos_chat`.`to_id` AS `to_id`,concat(`b`.`username`,' (',`b`.`location`,')') AS `to`,`ospos_chat`.`message` AS `message`,`ospos_chat`.`sent` AS `sent`,`ospos_chat`.`recd` AS `recd` from ((`ospos_chat` join `ospos_chat_users` `a`) join `ospos_chat_users` `b`) where ((`ospos_chat`.`from_id` = `a`.`chat_id`) and (`ospos_chat`.`to_id` = `b`.`chat_id`)) ;
