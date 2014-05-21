# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 64.15.140.154 (MySQL 5.5.36-cll)
# Database: seemytag
# Generation Time: 2014-05-19 15:12:39 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table wschat
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wschat`;

CREATE TABLE `wschat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `to` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `wschat` WRITE;
/*!40000 ALTER TABLE `wschat` DISABLE KEYS */;


/*!40000 ALTER TABLE `wschat` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wschat_typing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wschat_typing`;

CREATE TABLE `wschat_typing` (
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  `send` char(1) NOT NULL,
  PRIMARY KEY (`from`,`to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `wschat_typing` WRITE;
/*!40000 ALTER TABLE `wschat_typing` DISABLE KEYS */;

/*!40000 ALTER TABLE `wschat_typing` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
