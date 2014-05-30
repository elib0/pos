/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : possp

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-05-30 16:30:52
*/

SET FOREIGN_KEY_CHECKS=0;

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
