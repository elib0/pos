/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : possp_centralized

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-05-30 17:06:43
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
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

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
INSERT INTO `ospos_chat` VALUES ('22', '5', '6', 'eu', '2014-05-29 14:38:04', '1');
INSERT INTO `ospos_chat` VALUES ('23', '5', '6', 'eu', '2014-05-29 14:42:35', '1');
INSERT INTO `ospos_chat` VALUES ('24', '5', '6', 'eu', '2014-05-29 14:51:50', '1');
INSERT INTO `ospos_chat` VALUES ('25', '5', '6', 'eu again', '2014-05-29 14:52:35', '1');
INSERT INTO `ospos_chat` VALUES ('26', '6', '5', 'hola guapo', '2014-05-29 14:58:30', '1');
INSERT INTO `ospos_chat` VALUES ('27', '6', '5', 'hola', '2014-05-29 15:04:21', '1');
INSERT INTO `ospos_chat` VALUES ('28', '6', '5', 'ppp', '2014-05-29 15:04:44', '1');
INSERT INTO `ospos_chat` VALUES ('29', '5', '6', 'eu', '2014-05-30 10:07:56', '1');
INSERT INTO `ospos_chat` VALUES ('30', '6', '5', 'hola', '2014-05-30 10:12:40', '1');
INSERT INTO `ospos_chat` VALUES ('31', '5', '6', 'hola ramonsin', '2014-05-30 10:12:53', '1');
INSERT INTO `ospos_chat` VALUES ('32', '5', '6', 'eu', '2014-05-30 10:28:26', '1');
INSERT INTO `ospos_chat` VALUES ('33', '5', '6', 'rrrrrramonnn', '2014-05-30 10:33:43', '1');
INSERT INTO `ospos_chat` VALUES ('34', '6', '5', 'hola', '2014-05-30 10:35:03', '1');
INSERT INTO `ospos_chat` VALUES ('35', '5', '6', 'eu', '2014-05-30 11:21:07', '1');
INSERT INTO `ospos_chat` VALUES ('36', '6', '5', 'hola', '2014-05-30 11:21:29', '1');
INSERT INTO `ospos_chat` VALUES ('37', '6', '5', 'hola', '2014-05-30 11:22:13', '1');
INSERT INTO `ospos_chat` VALUES ('38', '6', '5', 'yu', '2014-05-30 11:23:10', '1');
INSERT INTO `ospos_chat` VALUES ('39', '5', '6', 'y\nu tu', '2014-05-30 11:23:30', '1');
INSERT INTO `ospos_chat` VALUES ('40', '6', '5', 'pero pero', '2014-05-30 11:23:54', '1');
INSERT INTO `ospos_chat` VALUES ('41', '5', '6', 'pero que?', '2014-05-30 11:25:36', '1');
INSERT INTO `ospos_chat` VALUES ('42', '5', '6', 'a', '2014-05-30 11:25:46', '1');
INSERT INTO `ospos_chat` VALUES ('43', '6', '5', 'mas vello', '2014-05-30 11:26:18', '1');
INSERT INTO `ospos_chat` VALUES ('44', '6', '5', 'bello', '2014-05-30 11:26:22', '1');
INSERT INTO `ospos_chat` VALUES ('45', '6', '5', 'bello', '2014-05-30 11:26:24', '1');
INSERT INTO `ospos_chat` VALUES ('46', '6', '5', 'beloo', '2014-05-30 11:26:26', '1');
INSERT INTO `ospos_chat` VALUES ('47', '5', '6', ':o', '2014-05-30 11:26:31', '1');
INSERT INTO `ospos_chat` VALUES ('48', '5', '6', 'yo \n<div class=surprise></div>', '2014-05-30 11:30:06', '1');
INSERT INTO `ospos_chat` VALUES ('49', '5', '6', 'a <div class=surprise></div> b <div class=smile></div> c', '2014-05-30 11:32:16', '1');
INSERT INTO `ospos_chat` VALUES ('50', '5', '6', 'a <div class=\"em surprise\"></div> b <div class=\"em smile\"></div> c', '2014-05-30 11:45:38', '1');
INSERT INTO `ospos_chat` VALUES ('51', '5', '6', '<div class=\"em surprise\"></div><div class=\"em surprise\"></div><div class=\"em smile\"></div>', '2014-05-30 11:48:08', '1');
INSERT INTO `ospos_chat` VALUES ('52', '5', '6', '<div class=\"em smile\"></div><div class=\"em sad\"></div><div class=\"em surprise\"></div>', '2014-05-30 11:49:25', '1');
INSERT INTO `ospos_chat` VALUES ('53', '6', '5', 'lkklk', '2014-05-30 11:51:13', '1');
INSERT INTO `ospos_chat` VALUES ('54', '6', '5', 'llll', '2014-05-30 11:51:15', '1');
INSERT INTO `ospos_chat` VALUES ('55', '6', '5', '<div class=\"em smile\"></div>', '2014-05-30 11:51:25', '1');
INSERT INTO `ospos_chat` VALUES ('56', '6', '5', '<div class=\"em smile\"></div>', '2014-05-30 11:51:35', '1');
INSERT INTO `ospos_chat` VALUES ('57', '6', '5', '(0.0)', '2014-05-30 11:51:49', '1');
INSERT INTO `ospos_chat` VALUES ('58', '6', '5', 'XD', '2014-05-30 11:51:55', '1');
INSERT INTO `ospos_chat` VALUES ('59', '6', '5', '<div class=\"em smile\"></div>', '2014-05-30 11:51:59', '1');
INSERT INTO `ospos_chat` VALUES ('60', '6', '5', '<div class=\"em smile\"></div><div class=\"em smile\"></div>', '2014-05-30 11:52:03', '1');
INSERT INTO `ospos_chat` VALUES ('61', '6', '5', '<div class=\"em smile\"></div><div class=\"em smile\"></div><div class=\"em smile\"></div><div class=\"em smile\"></div>:0', '2014-05-30 11:52:12', '1');
INSERT INTO `ospos_chat` VALUES ('62', '6', '5', '<div class=\"em smile\"></div><div class=\"em smile\"></div><div class=\"em smile\"></div>', '2014-05-30 11:52:19', '1');
INSERT INTO `ospos_chat` VALUES ('63', '6', '5', '<div class=\"em smile\"></div> hola', '2014-05-30 11:52:29', '1');
INSERT INTO `ospos_chat` VALUES ('64', '6', '5', 'hola t q', '2014-05-30 11:52:48', '1');
INSERT INTO `ospos_chat` VALUES ('65', '5', '6', '<div class=\"em surprise\"></div>', '2014-05-30 11:53:10', '1');
INSERT INTO `ospos_chat` VALUES ('66', '6', '6', 'hola', '2014-05-30 11:56:30', '1');
INSERT INTO `ospos_chat` VALUES ('67', '6', '6', '<div class=\"em smile\"></div>', '2014-05-30 11:56:36', '1');
INSERT INTO `ospos_chat` VALUES ('68', '5', '6', 'willem', '2014-05-30 11:57:01', '1');
INSERT INTO `ospos_chat` VALUES ('69', '6', '5', 'hola', '2014-05-30 11:57:15', '1');
INSERT INTO `ospos_chat` VALUES ('70', '5', '6', ':o', '2014-05-30 13:25:08', '1');
INSERT INTO `ospos_chat` VALUES ('71', '5', '6', ':(', '2014-05-30 13:32:57', '1');
INSERT INTO `ospos_chat` VALUES ('72', '5', '6', ':)', '2014-05-30 13:32:59', '1');
INSERT INTO `ospos_chat` VALUES ('73', '5', '6', 'eu', '2014-05-30 13:38:55', '1');
INSERT INTO `ospos_chat` VALUES ('74', '5', '6', 'eu', '2014-05-30 15:12:36', '1');
INSERT INTO `ospos_chat` VALUES ('75', '5', '6', 'hola guapo ;)', '2014-05-30 16:05:56', '1');
INSERT INTO `ospos_chat` VALUES ('76', '6', '5', 'hola', '2014-05-30 16:10:17', '1');
INSERT INTO `ospos_chat` VALUES ('77', '6', '5', ':)', '2014-05-30 16:10:34', '1');
INSERT INTO `ospos_chat` VALUES ('78', '5', '6', 'hola :)', '2014-05-30 16:10:35', '1');
INSERT INTO `ospos_chat` VALUES ('79', '6', '5', '&apos;\\', '2014-05-30 16:10:39', '1');
INSERT INTO `ospos_chat` VALUES ('80', '6', '5', '/////', '2014-05-30 16:11:46', '1');
INSERT INTO `ospos_chat` VALUES ('81', '6', '5', 'hola tu', '2014-05-30 16:12:02', '1');
INSERT INTO `ospos_chat` VALUES ('82', '6', '5', '--///&apos;&apos;&apos;&quot;', '2014-05-30 16:12:15', '1');
INSERT INTO `ospos_chat` VALUES ('83', '6', '5', '&quot;', '2014-05-30 16:12:24', '1');
INSERT INTO `ospos_chat` VALUES ('84', '6', '5', 'mmmmmm', '2014-05-30 16:12:37', '1');
INSERT INTO `ospos_chat` VALUES ('85', '6', '5', 'mmmooo', '2014-05-30 16:13:05', '1');
INSERT INTO `ospos_chat` VALUES ('86', '5', '6', 'kjdhfvhfg', '2014-05-30 16:13:40', '1');
INSERT INTO `ospos_chat` VALUES ('87', '6', '5', 'asjdj', '2014-05-30 16:14:02', '1');
INSERT INTO `ospos_chat` VALUES ('88', '6', '5', ':&apos;)', '2014-05-30 16:14:51', '1');
INSERT INTO `ospos_chat` VALUES ('89', '6', '5', ':&apos;(', '2014-05-30 16:15:06', '1');
INSERT INTO `ospos_chat` VALUES ('90', '6', '5', ':&apos;)', '2014-05-30 16:15:13', '1');
INSERT INTO `ospos_chat` VALUES ('91', '6', '5', '&apos;)', '2014-05-30 16:15:15', '1');
INSERT INTO `ospos_chat` VALUES ('92', '6', '5', '&apos;)', '2014-05-30 16:15:26', '1');
INSERT INTO `ospos_chat` VALUES ('93', '6', '5', '&apos;', '2014-05-30 16:15:45', '1');
INSERT INTO `ospos_chat` VALUES ('94', '6', '5', '&apos;&apos;', '2014-05-30 16:15:49', '1');
INSERT INTO `ospos_chat` VALUES ('95', '5', '6', '&quot;', '2014-05-30 16:15:57', '1');
INSERT INTO `ospos_chat` VALUES ('96', '5', '6', '&quot;', '2014-05-30 16:16:47', '1');
INSERT INTO `ospos_chat` VALUES ('97', '5', '6', '&quot;', '2014-05-30 16:17:27', '1');
INSERT INTO `ospos_chat` VALUES ('98', '5', '6', '-a&quot; a&quot; o &apos;&apos;', '2014-05-30 16:17:49', '1');
INSERT INTO `ospos_chat` VALUES ('99', '5', '6', 'a\" b\'', '2014-05-30 16:18:42', '1');
INSERT INTO `ospos_chat` VALUES ('100', '7', '6', 'hola', '2014-05-30 16:20:27', '1');
INSERT INTO `ospos_chat` VALUES ('101', '7', '5', 'soy bata', '2014-05-30 16:20:33', '1');
INSERT INTO `ospos_chat` VALUES ('102', '6', '7', 'quien es?', '2014-05-30 16:20:35', '1');
INSERT INTO `ospos_chat` VALUES ('103', '6', '7', ':O', '2014-05-30 16:20:38', '1');
INSERT INTO `ospos_chat` VALUES ('104', '6', '7', 'responde!', '2014-05-30 16:21:10', '1');
INSERT INTO `ospos_chat` VALUES ('105', '7', '6', ':)', '2014-05-30 16:21:10', '1');
INSERT INTO `ospos_chat` VALUES ('106', '7', '6', ':(', '2014-05-30 16:21:13', '1');
INSERT INTO `ospos_chat` VALUES ('107', '7', '6', ':\'(', '2014-05-30 16:21:19', '1');
INSERT INTO `ospos_chat` VALUES ('108', '5', '7', ':o', '2014-05-30 16:21:43', '1');
INSERT INTO `ospos_chat` VALUES ('109', '7', '5', 'epale', '2014-05-30 16:21:52', '1');
INSERT INTO `ospos_chat` VALUES ('110', '5', '7', 'no sale tu nombre :(', '2014-05-30 16:21:59', '1');
INSERT INTO `ospos_chat` VALUES ('111', '7', '6', 'ahora si llego uno', '2014-05-30 16:21:59', '1');
INSERT INTO `ospos_chat` VALUES ('112', '5', '7', ':\'(', '2014-05-30 16:22:03', '1');
INSERT INTO `ospos_chat` VALUES ('113', '7', '6', 'tal vez willen la cago', '2014-05-30 16:22:06', '1');
INSERT INTO `ospos_chat` VALUES ('114', '7', '5', ':)', '2014-05-30 16:22:12', '1');
INSERT INTO `ospos_chat` VALUES ('115', '7', '5', ':(', '2014-05-30 16:22:13', '1');
INSERT INTO `ospos_chat` VALUES ('116', '6', '7', 'aca tres', '2014-05-30 16:22:35', '1');
INSERT INTO `ospos_chat` VALUES ('117', '7', '6', 'pppppp', '2014-05-30 16:23:12', '1');
INSERT INTO `ospos_chat` VALUES ('118', '5', '7', ':\'(', '2014-05-30 16:23:28', '1');
INSERT INTO `ospos_chat` VALUES ('119', '6', '7', 'dime quien eres?', '2014-05-30 16:23:37', '1');
INSERT INTO `ospos_chat` VALUES ('120', '7', '7', 'hola', '2014-05-30 16:23:53', '1');
INSERT INTO `ospos_chat` VALUES ('121', '5', '7', '\" aaa', '2014-05-30 16:23:56', '1');
INSERT INTO `ospos_chat` VALUES ('122', '5', '7', '\'aa', '2014-05-30 16:23:59', '1');
INSERT INTO `ospos_chat` VALUES ('123', '7', '7', 'mas bello', '2014-05-30 16:24:07', '1');
INSERT INTO `ospos_chat` VALUES ('124', '6', '6', 'hola', '2014-05-30 16:24:08', '1');
INSERT INTO `ospos_chat` VALUES ('125', '6', '6', 'quien eres?', '2014-05-30 16:24:18', '1');
INSERT INTO `ospos_chat` VALUES ('126', '6', '6', 'tu primero', '2014-05-30 16:24:23', '1');
INSERT INTO `ospos_chat` VALUES ('127', '6', '6', 'yo pregunte primero', '2014-05-30 16:24:28', '1');
INSERT INTO `ospos_chat` VALUES ('128', '6', '6', 'noooooo', '2014-05-30 16:24:31', '1');
INSERT INTO `ospos_chat` VALUES ('129', '6', '6', 'yo', '2014-05-30 16:24:32', '1');
INSERT INTO `ospos_chat` VALUES ('130', '6', '6', 'me llamo miharbi', '2014-05-30 16:24:47', '1');
INSERT INTO `ospos_chat` VALUES ('131', '5', '5', ':(', '2014-05-30 16:25:18', '1');
INSERT INTO `ospos_chat` VALUES ('132', '5', '5', '\" a \' b', '2014-05-30 16:25:29', '1');
INSERT INTO `ospos_chat` VALUES ('133', '7', '6', '<a href=http://www.desarrolloweb.com/articulos/video-xampp-mercury-mail.html target=_blank>http://www.desarrolloweb.com/articulos/video-xampp-mercury-mail.html</a>', '2014-05-30 16:25:49', '1');
INSERT INTO `ospos_chat` VALUES ('134', '5', '5', '<a href=http://google.co.ve target=_blank>http://google.co.ve</a>', '2014-05-30 16:26:59', '1');
INSERT INTO `ospos_chat` VALUES ('135', '6', '7', 'no me vas a decir tu nombre?', '2014-05-30 16:27:36', '1');
INSERT INTO `ospos_chat` VALUES ('136', '7', '8', 'hola', '2014-05-30 16:48:55', '1');
INSERT INTO `ospos_chat` VALUES ('137', '7', '8', 'rey', '2014-05-30 16:48:57', '1');
INSERT INTO `ospos_chat` VALUES ('138', '7', '8', 'mamu', '2014-05-30 16:48:59', '1');
INSERT INTO `ospos_chat` VALUES ('139', '7', '8', 'eres', '2014-05-30 16:49:00', '1');
INSERT INTO `ospos_chat` VALUES ('140', '7', '8', 'tu', '2014-05-30 16:49:03', '1');
INSERT INTO `ospos_chat` VALUES ('141', '7', '7', 'hay alguien', '2014-05-30 16:49:15', '1');
INSERT INTO `ospos_chat` VALUES ('142', '7', '6', 'portate bien', '2014-05-30 16:49:27', '0');
INSERT INTO `ospos_chat` VALUES ('143', '7', '7', 'hola', '2014-05-30 16:49:31', '1');
INSERT INTO `ospos_chat` VALUES ('144', '7', '5', 'hola', '2014-05-30 16:49:38', '0');
INSERT INTO `ospos_chat` VALUES ('145', '7', '6', 'hola1', '2014-05-30 16:49:50', '0');
INSERT INTO `ospos_chat` VALUES ('146', '7', '5', 'hola1', '2014-05-30 16:49:52', '0');
INSERT INTO `ospos_chat` VALUES ('147', '7', '8', 'hola1', '2014-05-30 16:49:55', '1');
INSERT INTO `ospos_chat` VALUES ('148', '7', '8', 'hola21', '2014-05-30 16:49:57', '1');
INSERT INTO `ospos_chat` VALUES ('149', '7', '5', 'hola2', '2014-05-30 16:49:59', '0');
INSERT INTO `ospos_chat` VALUES ('150', '7', '6', 'hola2', '2014-05-30 16:50:02', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_chat_users
-- ----------------------------
INSERT INTO `ospos_chat_users` VALUES ('5', '43', 'default', 'wfranco', '2', '0', '2014-05-30 16:45:18');
INSERT INTO `ospos_chat_users` VALUES ('6', '1', 'default', 'admin', '2', '0', '2014-05-30 16:45:52');
INSERT INTO `ospos_chat_users` VALUES ('7', '42', 'default', '', '1', '0', '2014-05-30 16:48:54');
INSERT INTO `ospos_chat_users` VALUES ('8', '1', 'posspq', '', '2', '0', '2014-05-30 16:45:52');

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
INSERT INTO `ospos_chat_user_typing` VALUES ('5', '5', '', '2014-05-30 16:26:59');
INSERT INTO `ospos_chat_user_typing` VALUES ('5', '6', '', '2014-05-30 16:18:42');
INSERT INTO `ospos_chat_user_typing` VALUES ('5', '7', '', '2014-05-30 16:23:59');
INSERT INTO `ospos_chat_user_typing` VALUES ('6', '5', '', '2014-05-30 16:15:49');
INSERT INTO `ospos_chat_user_typing` VALUES ('6', '6', '', '2014-05-30 16:24:47');
INSERT INTO `ospos_chat_user_typing` VALUES ('6', '7', '', '2014-05-30 16:27:36');
INSERT INTO `ospos_chat_user_typing` VALUES ('7', '5', '', '2014-05-30 16:49:59');
INSERT INTO `ospos_chat_user_typing` VALUES ('7', '6', '', '2014-05-30 16:50:02');
INSERT INTO `ospos_chat_user_typing` VALUES ('7', '7', '', '2014-05-30 16:49:31');
INSERT INTO `ospos_chat_user_typing` VALUES ('7', '8', '', '2014-05-30 16:49:57');
INSERT INTO `ospos_chat_user_typing` VALUES ('8', '5', '', '2014-05-30 16:41:08');
INSERT INTO `ospos_chat_user_typing` VALUES ('8', '6', '', '2014-05-30 16:41:09');
INSERT INTO `ospos_chat_user_typing` VALUES ('8', '7', '', '2014-05-30 16:41:08');

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
