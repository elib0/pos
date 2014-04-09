/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : possp

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-04-09 09:16:21
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
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'customers', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'items', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'item_kits', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'suppliers', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'reports', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'receivings', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'sales', 'none');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'employees', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'giftcards', 'add,update,delete');
INSERT INTO `ospos_employees_profile` VALUES ('administrator', 'config', 'save');

UPDATE ospos_employees SET ospos_employees.type_employees='administrator';
