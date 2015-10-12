# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.23)
# Database: SSL
# Generation Time: 2015-10-12 15:03:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table fruits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fruits`;

CREATE TABLE `fruits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `colour` varchar(32) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

LOCK TABLES `fruits` WRITE;
/*!40000 ALTER TABLE `fruits` DISABLE KEYS */;

INSERT INTO `fruits` (`id`, `name`, `colour`, `image`)
VALUES
	(0,'Orange','Orange','Orange.jpg'),
	(1,'Apple','Red','Apple.jpg'),
	(2,'Pear','Green','Pear.jpg'),
	(3,'Plum','Purple','Plum.jpg'),
	(4,'Miraclefruit','Red','Miraclefruit.jpg'),
	(5,'Tuna','Red','Tuna.jpg'),
	(6,'BlackBerry','Black','BlackBerry.jpg'),
	(7,'Banana','Yellow','Banana.jpg'),
	(8,'Apple','Red','FujiApple.jpg'),
	(9,'Apple','Yellow','GoldenDeliciousApple.jpg');

/*!40000 ALTER TABLE `fruits` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
