/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : possp

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-04-03 11:01:12
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ospos_observation_inventories
-- ----------------------------
ALTER TABLE ospos_employees ADD type_employees VARCHAR(20);
UPDATE ospos_employees SET ospos_employees.type_employees='Administrator';
