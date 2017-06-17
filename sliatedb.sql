/*
SQLyog Ultimate v8.55 
MySQL - 5.5.38 : Database - sliatedb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sliatedb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sliatedb`;

/*Table structure for table `ati` */

DROP TABLE IF EXISTS `ati`;

CREATE TABLE `ati` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `atiname` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `tp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ati` */

insert  into `ati`(`id`,`atiname`,`address`,`tp`) values (1,'Head Office','Rajagiriya','031'),(2,'naiwala','Veyangoda',NULL);

/*Table structure for table `event_ati` */

DROP TABLE IF EXISTS `event_ati`;

CREATE TABLE `event_ati` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `userid` int(5) DEFAULT NULL,
  `atiid` int(5) DEFAULT NULL,
  `createdtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statuscode` varchar(10) DEFAULT 'ACT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `event_ati` */

/*Table structure for table `photo_event` */

DROP TABLE IF EXISTS `photo_event`;

CREATE TABLE `photo_event` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `photopath` varchar(200) DEFAULT NULL,
  `userid` int(5) DEFAULT NULL,
  `statuscode` varchar(10) DEFAULT NULL,
  `eventid` int(5) DEFAULT NULL,
  `atiname` varchar(100) DEFAULT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedtime` timestamp NULL DEFAULT NULL,
  `updateduser` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `photo_event` */

/*Table structure for table `user_tbl` */

DROP TABLE IF EXISTS `user_tbl`;

CREATE TABLE `user_tbl` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(500) DEFAULT NULL,
  `lastname` varchar(500) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pword` text,
  `statuscode` varchar(5) DEFAULT NULL,
  `rolecode` varchar(20) DEFAULT NULL,
  `ati` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_tbl` */

insert  into `user_tbl`(`id`,`firstname`,`lastname`,`username`,`pword`,`statuscode`,`rolecode`,`ati`) values (1,'Ravinath','fernando','a','*667F407DE7C6AD07358FA38DAED7828A72014B4E','ACT','ATI',2),(2,'admin','admin','admin','*667F407DE7C6AD07358FA38DAED7828A72014B4E','ACT','ADM',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
