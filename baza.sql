/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.11-MariaDB : Database - zivotinje
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zivotinje` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `zivotinje`;

/*Table structure for table `vrsta` */

DROP TABLE IF EXISTS `vrsta`;

CREATE TABLE `vrsta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vrsta` */

insert  into `vrsta`(`id`,`naziv`) values 
(1,'pas'),
(6,'hrcak'),
(7,'papagaj'),
(8,'Doberman'),
(11,'macka');

/*Table structure for table `zivotinja` */

DROP TABLE IF EXISTS `zivotinja`;

CREATE TABLE `zivotinja` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vrsta_id` bigint(20) DEFAULT NULL,
  `ime` varchar(40) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `slika` text DEFAULT NULL,
  `starost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vrsta_id` (`vrsta_id`),
  CONSTRAINT `zivotinja_ibfk_1` FOREIGN KEY (`vrsta_id`) REFERENCES `vrsta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `zivotinja` */

insert  into `zivotinja`(`id`,`vrsta_id`,`ime`,`opis`,`slika`,`starost`) values 
(14,11,'macka','\r\n                    dfagdha','./img/macka.jpg',1),
(15,1,'stafordgghj','                    afdsf\r\n                                        ','./img/staford.jpg',2),
(16,6,'neki hrcak','afdg','./img/hrcak.jpg',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
