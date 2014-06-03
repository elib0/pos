/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : possp_centralized

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-06-03 10:54:17
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat_users
-- ----------------------------

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

-- ----------------------------
-- View structure for `ospos_chat_users_view`
-- ----------------------------
DROP VIEW IF EXISTS `ospos_chat_users_view`;
CREATE VIEW `ospos_chat_users_view` AS select `ospos_chat_users`.`chat_id` AS `chat_id`,`ospos_chat_users`.`user_id` AS `user_id`,concat(`ospos_chat_users`.`username`,' (',`ospos_chat_users`.`location`,')') AS `user`,`ospos_chat_users`.`location` AS `location`,`ospos_chat_users`.`username` AS `username`,if(`ospos_chat_users`.`disabled`,0,`ospos_chat_users`.`status`) AS `status_id`,`ospos_chat_status`.`name` AS `status_name`,`ospos_chat_users`.`disabled` AS `disabled`,`ospos_chat_users`.`last_action` AS `last_action` from (`ospos_chat_users` join `ospos_chat_status`) where (if(`ospos_chat_users`.`disabled`,0,`ospos_chat_users`.`status`) = `ospos_chat_status`.`id`) ;

-- ----------------------------
-- View structure for `ospos_chat_view`
-- ----------------------------
DROP VIEW IF EXISTS `ospos_chat_view`;
CREATE VIEW `ospos_chat_view` AS select `ospos_chat`.`id` AS `id`,`ospos_chat`.`from_id` AS `from_id`,concat(`a`.`username`,' (',`a`.`location`,')') AS `from`,`ospos_chat`.`to_id` AS `to_id`,concat(`b`.`username`,' (',`b`.`location`,')') AS `to`,`ospos_chat`.`message` AS `message`,`ospos_chat`.`sent` AS `sent`,`ospos_chat`.`recd` AS `recd` from ((`ospos_chat` join `ospos_chat_users` `a`) join `ospos_chat_users` `b`) where ((`ospos_chat`.`from_id` = `a`.`chat_id`) and (`ospos_chat`.`to_id` = `b`.`chat_id`)) ;
