/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.31 : Database - inventorymanagement
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventorymanagement` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `inventorymanagement`;

/*Table structure for table `tbldepartment` */

DROP TABLE IF EXISTS `tbldepartment`;

CREATE TABLE `tbldepartment` (
  `department_pk` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `product_status` int(11) DEFAULT '0' COMMENT '1=Active, 0=InActive',
  PRIMARY KEY (`department_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbldepartment` */

insert  into `tbldepartment`(`department_pk`,`department_name`,`product_status`) values 
(1,'Stock',1),
(2,'Marketing',0),
(3,'Admin',0);

/*Table structure for table `tblproduct_sales_months` */

DROP TABLE IF EXISTS `tblproduct_sales_months`;

CREATE TABLE `tblproduct_sales_months` (
  `product_fk` int(11) DEFAULT NULL,
  `January` int(11) DEFAULT '0',
  `February` int(11) DEFAULT '0',
  `March` int(11) DEFAULT '0',
  `April` int(11) DEFAULT '0',
  `May` int(11) DEFAULT '0',
  `June` int(11) DEFAULT '0',
  `July` int(11) DEFAULT '0',
  `August` int(11) DEFAULT '0',
  `September` int(11) DEFAULT '0',
  `October` int(11) DEFAULT '0',
  `November` int(11) DEFAULT '0',
  `December` int(11) DEFAULT '0',
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_sales_months` */

insert  into `tblproduct_sales_months`(`product_fk`,`January`,`February`,`March`,`April`,`May`,`June`,`July`,`August`,`September`,`October`,`November`,`December`) values 
(1,0,0,0,0,0,0,0,0,0,0,0,0),
(2,0,0,0,0,0,0,0,0,0,0,0,0),
(3,0,0,0,0,0,0,0,0,0,0,0,0),
(4,0,0,0,0,0,0,0,0,0,0,0,0),
(5,0,0,0,0,0,0,0,0,0,0,0,0),
(6,0,0,0,0,0,0,0,0,0,0,0,0),
(7,0,0,0,0,0,0,0,0,0,0,0,0),
(8,0,0,0,0,0,0,0,0,0,0,0,0),
(9,0,0,0,0,0,0,0,0,0,0,0,0),
(10,0,0,0,0,0,0,0,0,0,0,0,0),
(11,0,0,0,0,0,0,0,0,0,0,0,0),
(12,0,0,0,0,0,0,0,0,0,0,0,0),
(13,0,0,0,0,0,0,0,0,0,0,0,0),
(14,0,0,0,0,0,0,0,0,0,0,0,0),
(15,0,0,0,0,0,0,0,0,0,0,0,0),
(16,0,0,0,0,0,0,0,0,0,0,0,0),
(17,0,0,0,0,0,0,0,0,0,0,0,0),
(18,0,0,0,0,0,0,0,0,0,0,0,0),
(19,0,0,0,0,0,0,0,0,0,0,0,0),
(20,0,0,0,0,0,0,0,0,0,0,0,0),
(21,0,0,0,0,0,0,0,0,0,0,0,0),
(22,0,0,0,0,0,0,0,0,0,0,0,0),
(23,0,0,0,0,0,0,0,0,0,0,0,0),
(24,0,0,0,0,0,0,0,0,0,0,0,0),
(25,0,0,0,0,0,0,0,0,0,0,0,0),
(26,0,0,0,0,0,0,0,0,0,0,0,0),
(27,0,0,0,0,0,0,0,0,0,0,0,0),
(28,0,0,0,0,0,0,0,0,0,0,0,0),
(29,0,0,0,0,0,0,0,0,0,0,0,0),
(30,0,0,0,0,0,0,0,0,0,0,0,0),
(31,0,0,0,0,0,0,0,0,0,0,0,0),
(32,0,0,0,0,0,0,0,0,0,0,0,0),
(33,0,0,0,0,0,0,0,0,0,0,0,0),
(34,0,0,0,0,0,0,0,0,0,0,0,0),
(35,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `tblproduct_sales_months_history` */

DROP TABLE IF EXISTS `tblproduct_sales_months_history`;

CREATE TABLE `tblproduct_sales_months_history` (
  `datetime` timestamp NULL DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `January` int(11) DEFAULT '0',
  `February` int(11) DEFAULT '0',
  `March` int(11) DEFAULT '0',
  `April` int(11) DEFAULT '0',
  `May` int(11) DEFAULT '0',
  `June` int(11) DEFAULT '0',
  `July` int(11) DEFAULT '0',
  `August` int(11) DEFAULT '0',
  `September` int(11) DEFAULT '0',
  `October` int(11) DEFAULT '0',
  `November` int(11) DEFAULT '0',
  `December` int(11) DEFAULT '0',
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_sales_months_history` */

insert  into `tblproduct_sales_months_history`(`datetime`,`product_fk`,`January`,`February`,`March`,`April`,`May`,`June`,`July`,`August`,`September`,`October`,`November`,`December`) values 
('2024-07-07 13:32:30',1,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',2,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',3,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',4,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',5,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',6,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',7,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',8,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',9,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',10,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',11,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',12,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',13,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',14,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',15,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-07-07 13:32:30',16,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',1,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',2,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',3,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',4,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',5,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',6,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',7,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',8,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',9,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',10,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',11,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',12,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',13,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',14,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',15,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-12-25 13:39:24',16,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',1,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',2,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',3,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',4,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',5,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',6,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',7,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',8,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',9,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',10,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',11,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',12,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',13,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',14,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',15,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',16,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',17,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',18,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',19,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',20,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',21,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',22,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',23,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',24,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',25,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',26,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',27,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',28,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',29,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',30,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',31,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',32,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',33,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',34,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-08 10:55:45',35,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `tblproduct_transaction` */

DROP TABLE IF EXISTS `tblproduct_transaction`;

CREATE TABLE `tblproduct_transaction` (
  `product_pk` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `product_status` int(11) DEFAULT '1' COMMENT '1=Active, 0=InActive',
  `ETA` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `Pre_Order` int(11) DEFAULT '0',
  PRIMARY KEY (`product_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction` */

insert  into `tblproduct_transaction`(`product_pk`,`product_name`,`product_status`,`ETA`,`RMA`,`Consignment_Stock`,`Pre_Order`) values 
(1,'Naraka',1,0,0,10,0),
(2,'Fanta',1,0,0,0,10),
(3,'Apex Legend',1,0,0,0,0),
(4,'AK',1,0,0,0,0),
(5,'JX',1,0,0,0,0),
(6,'Cambodia',1,0,0,0,0),
(7,'Coca',1,0,0,0,0),
(8,'Dasani',1,0,0,0,0),
(9,'Mirinda',1,0,0,0,0),
(10,'Fafa',1,0,0,0,0),
(11,'Cat',1,0,0,0,0),
(12,'Dog',1,0,0,0,0),
(13,'Dianosur',1,0,0,0,0),
(14,'Nike',1,0,0,0,0),
(15,'Addidas',1,0,0,0,0),
(16,'Puma',1,0,0,0,0),
(17,'Salah',1,0,0,0,0),
(18,'Nasa',1,0,0,0,0),
(19,'USA',1,0,0,0,0),
(20,'Panama',1,0,0,0,0),
(21,'Japanese',1,0,0,0,0),
(22,'Canada',1,0,0,0,0),
(23,'Yakuza',1,0,0,0,0),
(24,'Brazil',1,0,0,0,0),
(25,'England',1,0,0,0,0),
(26,'Spain',1,0,0,0,0),
(27,'Argentina',1,0,0,0,0),
(28,'Sweden',1,0,0,0,0),
(29,'Vietnam',1,0,0,0,0),
(30,'Laos',1,0,0,0,0),
(31,'China',1,0,0,0,0),
(32,'Finland',1,0,0,0,0),
(33,'Korea',1,0,0,0,0),
(34,'Brada',1,0,0,0,0),
(35,'Mabochioka',1,0,0,0,0);

/*Table structure for table `tblproduct_transaction_history` */

DROP TABLE IF EXISTS `tblproduct_transaction_history`;

CREATE TABLE `tblproduct_transaction_history` (
  `user_fk` int(11) DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateTime` timestamp NULL DEFAULT NULL,
  `ETA` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `Pre_Order` int(11) DEFAULT '0',
  KEY `user_fk` (`user_fk`),
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction_history` */

insert  into `tblproduct_transaction_history`(`user_fk`,`product_fk`,`product_name`,`dateTime`,`ETA`,`RMA`,`Consignment_Stock`,`Pre_Order`) values 
(1,1,'Naraka','2024-07-07 13:32:30',1,10,0,0),
(2,2,'Fanta','2024-07-07 13:32:30',0,0,0,0),
(3,3,'Apex Legend','2024-07-07 13:32:30',0,0,0,0),
(4,4,'AK','2024-07-07 13:32:30',0,0,0,0),
(5,5,'JX','2024-07-07 13:32:30',0,0,0,0),
(6,6,'Cambodia','2024-07-07 13:32:30',0,0,0,0),
(7,7,'Coca','2024-07-07 13:32:30',0,0,0,0),
(8,8,'Dasani','2024-07-07 13:32:30',0,0,0,0),
(9,9,'Mirinda','2024-07-07 13:32:30',0,0,0,0),
(10,10,'Fafa','2024-07-07 13:32:30',0,0,0,0),
(11,11,'Cat','2024-07-07 13:32:30',0,0,0,0),
(12,12,'Dog','2024-07-07 13:32:30',0,0,0,0),
(13,13,'Dianosur','2024-07-07 13:32:30',0,0,0,0),
(14,14,'Nike','2024-07-07 13:32:30',0,0,0,0),
(15,15,'Addidas','2024-07-07 13:32:30',0,0,0,0),
(16,16,'Puma','2024-07-07 13:32:30',0,0,0,0),
(1,1,'Naraka','2024-12-25 13:39:24',10,10,100,0),
(2,2,'Fanta','2024-12-25 13:39:24',0,0,0,0),
(3,3,'Apex Legend','2024-12-25 13:39:24',0,0,0,0),
(4,4,'AK','2024-12-25 13:39:24',0,0,0,0),
(5,5,'JX','2024-12-25 13:39:24',0,0,0,0),
(6,6,'Cambodia','2024-12-25 13:39:24',0,0,0,0),
(7,7,'Coca','2024-12-25 13:39:24',0,0,0,0),
(8,8,'Dasani','2024-12-25 13:39:24',0,0,0,0),
(9,9,'Mirinda','2024-12-25 13:39:24',0,0,0,0),
(10,10,'Fafa','2024-12-25 13:39:24',0,0,0,0),
(11,11,'Cat','2024-12-25 13:39:24',0,0,0,0),
(12,12,'Dog','2024-12-25 13:39:24',0,0,0,0),
(13,13,'Dianosur','2024-12-25 13:39:24',0,0,0,0),
(14,14,'Nike','2024-12-25 13:39:24',0,0,0,0),
(15,15,'Addidas','2024-12-25 13:39:24',0,0,0,0),
(16,16,'Puma','2024-12-25 13:39:24',0,0,0,0),
(1,1,'Naraka','2024-05-08 10:55:45',150,0,1321,0),
(2,2,'Fanta','2024-05-08 10:55:45',250,0,0,0),
(3,3,'Apex Legend','2024-05-08 10:55:45',0,0,0,0),
(4,4,'AK','2024-05-08 10:55:45',1500,0,800,0),
(5,5,'JX','2024-05-08 10:55:45',0,0,0,0),
(6,6,'Cambodia','2024-05-08 10:55:45',0,0,0,0),
(7,7,'Coca','2024-05-08 10:55:45',0,0,0,0),
(8,8,'Dasani','2024-05-08 10:55:45',0,0,0,0),
(9,9,'Mirinda','2024-05-08 10:55:45',0,0,0,0),
(10,10,'Fafa','2024-05-08 10:55:45',0,0,0,0),
(11,11,'Cat','2024-05-08 10:55:45',0,0,0,0),
(12,12,'Dog','2024-05-08 10:55:45',0,0,0,0),
(13,13,'Dianosur','2024-05-08 10:55:45',0,0,0,0),
(14,14,'Nike','2024-05-08 10:55:45',0,0,0,0),
(15,15,'Addidas','2024-05-08 10:55:45',0,0,0,0),
(16,16,'Puma','2024-05-08 10:55:45',0,0,0,0),
(17,17,'Salah','2024-05-08 10:55:45',0,0,0,0),
(18,18,'Nasa','2024-05-08 10:55:45',0,0,0,0),
(19,19,'USA','2024-05-08 10:55:45',0,0,0,0),
(20,20,'Panama','2024-05-08 10:55:45',0,0,0,0),
(21,21,'Japanese','2024-05-08 10:55:45',0,0,0,0),
(22,22,'Canada','2024-05-08 10:55:45',0,0,0,0),
(23,23,'Yakuza','2024-05-08 10:55:45',0,0,0,0),
(24,24,'Brazil','2024-05-08 10:55:45',0,0,0,0),
(25,25,'England','2024-05-08 10:55:45',0,0,0,0),
(26,26,'Spain','2024-05-08 10:55:45',0,0,0,0),
(27,27,'Argentina','2024-05-08 10:55:45',0,0,0,0),
(28,28,'Sweden','2024-05-08 10:55:45',0,0,0,0),
(29,29,'Vietnam','2024-05-08 10:55:45',0,0,0,0),
(30,30,'Laos','2024-05-08 10:55:45',0,0,0,0),
(31,31,'China','2024-05-08 10:55:45',0,0,0,0),
(32,32,'Finland','2024-05-08 10:55:45',0,0,0,0),
(33,33,'Korea','2024-05-08 10:55:45',0,0,0,0),
(34,34,'Brada','2024-05-08 10:55:45',0,0,0,0),
(35,35,'Mabochioka','2024-05-08 10:55:45',0,0,0,0);

/*Table structure for table `tblproductadjustpermission` */

DROP TABLE IF EXISTS `tblproductadjustpermission`;

CREATE TABLE `tblproductadjustpermission` (
  `department_fk` int(11) DEFAULT NULL,
  `product_tran_name_str` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  KEY `product_tran_name_fk` (`product_tran_name_str`),
  KEY `user_fk` (`department_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproductadjustpermission` */

insert  into `tblproductadjustpermission`(`department_fk`,`product_tran_name_str`) values 
(1,'ETA'),
(1,'RMA'),
(2,'ETA'),
(3,'ETA'),
(3,'RMA');

/*Table structure for table `tbluser` */

DROP TABLE IF EXISTS `tbluser`;

CREATE TABLE `tbluser` (
  `user_pk` int(11) NOT NULL AUTO_INCREMENT,
  `user_department_fk` int(11) DEFAULT NULL,
  `user_level_fk` int(11) DEFAULT NULL,
  `user_full_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `user_log_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `user_log_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`user_pk`),
  KEY `tbluser_ibfk_2` (`user_level_fk`),
  KEY `tbluser_ibfk_3` (`user_department_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbluser` */

insert  into `tbluser`(`user_pk`,`user_department_fk`,`user_level_fk`,`user_full_name`,`user_log_name`,`user_log_password`) values 
(1,3,1,'Dolla Sok','Dolla','123'),
(2,1,2,'Dara','Dara','123'),
(3,3,2,'Heng','Heng','123'),
(4,3,1,'John Cena','John Cena','123'),
(5,1,2,'Kaka','Kaka','123'),
(6,2,2,'Benny','Benny','123'),
(7,2,2,'Lisa','Lisa','123');

/*Table structure for table `tbluserlevel` */

DROP TABLE IF EXISTS `tbluserlevel`;

CREATE TABLE `tbluserlevel` (
  `userlever_pk` int(11) NOT NULL AUTO_INCREMENT,
  `userlevel_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`userlever_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbluserlevel` */

insert  into `tbluserlevel`(`userlever_pk`,`userlevel_name`) values 
(1,'Admin'),
(2,'Staff');

/* Function  structure for function  `fn_exist_user` */

/*!50003 DROP FUNCTION IF EXISTS `fn_exist_user` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `fn_exist_user`(u_full_name varchar(100)) RETURNS int(11)
BEGIN
	-- if return 0 not exist user
	return(select count(*) from `tbluser` where `user_full_name` = u_full_name);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `Delete_Column` */

/*!50003 DROP PROCEDURE IF EXISTS  `Delete_Column` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Delete_Column`(IN table_name VARCHAR(100), IN column_name VARCHAR(100))
BEGIN
    DECLARE column_exists INT;
    -- Check if the column exists in the table
    SELECT COUNT(*) INTO column_exists
    FROM information_schema.columns
    WHERE table_name = table_name
      AND column_name = column_name;
    IF column_exists > 0 THEN
        -- Drop the column for tblproduct_transaction
        SET @query1 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction` DROP COLUMN ', column_name , ';');
        PREPARE stmt1 FROM @query1;
        EXECUTE stmt1;
        DEALLOCATE PREPARE stmt1;
        
        -- Delete from tblproductadjustpermission where product_tran_name_str matches
        SET @delete_query = CONCAT('DELETE FROM tblproductadjustpermission WHERE product_tran_name_str = ''', column_name, ''';');
        PREPARE delete_stmt FROM @delete_query;
        EXECUTE delete_stmt;
        DEALLOCATE PREPARE delete_stmt;
        SELECT 'Column dropped successfully' AS Result;
    ELSE
        SELECT 'Column does not exist' AS Result;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Delete_Department_Grant` */

/*!50003 DROP PROCEDURE IF EXISTS  `Delete_Department_Grant` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Delete_Department_Grant`(depart_fk int)
BEGIN
		-- delete if exists department used to grant
		DELETE FROM `tblproductadjustpermission` WHERE `department_fk` = depart_pk;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Grand_Department_Permission` */

/*!50003 DROP PROCEDURE IF EXISTS  `Grand_Department_Permission` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Grand_Department_Permission`(depart_fk int , tran_name varchar(200))
BEGIN
		-- grant
		insert into `tbldepartment` (`department_pk`,`department_name`)
		values (depart_fk,tran_name);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Grant_Department_Permission` */

/*!50003 DROP PROCEDURE IF EXISTS  `Grant_Department_Permission` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Grant_Department_Permission`(depart_fk int , tran_name varchar(200))
BEGIN
		-- grant new access permission by department
		insert into `tbldepartment` (`department_pk`,`department_name`)
		values (depart_fk,tran_name);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_Column` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_Column` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_Column`(IN column_name  VARCHAR(100))
BEGIN
    SET @query1 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction` ADD COLUMN ', column_name , ' INT (11) DEFAULT 0 NULL ;');
    SET @query2 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction_history` ADD COLUMN ', column_name , ' INT (11) DEFAULT 0 ;');
    
    PREPARE stmt1 FROM @query1;
    EXECUTE stmt1;
    DEALLOCATE PREPARE stmt1;
    PREPARE stmt2 FROM @query2;
    EXECUTE stmt2;
    DEALLOCATE PREPARE stmt2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_data` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_data`()
BEGIN
    DECLARE columns_query VARCHAR(1000);
    DECLARE column_names VARCHAR(1000);
    DECLARE column_values VARCHAR(1000);
    DECLARE existing_count_trans INT;
    DECLARE existing_count_sales INT;

    -- Get column names from tblproduct_transaction
    SET @columns_query = CONCAT('SELECT GROUP_CONCAT(column_name) INTO @column_names FROM information_schema.columns WHERE table_schema = \'inventorymanagement\' AND table_name = \'tblproduct_transaction\' AND column_name NOT IN (\'product_pk\', \'product_status\');');
    PREPARE stmt_columns FROM @columns_query;
    EXECUTE stmt_columns;
    DEALLOCATE PREPARE stmt_columns;

    -- Generate column names for INSERT statement
    SET @column_names = REPLACE(@column_names, 'product_name,', ''); -- Remove 'product_name' from the column names
    SET @column_names = TRIM(BOTH ',' FROM @column_names); -- Trim any leading or trailing commas

    -- Generate column values for INSERT statement
    SET @column_values = REPLACE(@column_names, ',', ', ');

    -- Check if data with the same year and month already exists in tblproduct_transaction_history
    SELECT COUNT(*) INTO existing_count_trans FROM tblproduct_transaction_history WHERE YEAR(dateTime) = YEAR(NOW()) AND MONTH(dateTime) = MONTH(NOW());

    IF existing_count_trans > 0 THEN
        -- Delete existing data with the same year and month
        DELETE FROM tblproduct_transaction_history WHERE YEAR(dateTime) = YEAR(NOW()) AND MONTH(dateTime) = MONTH(NOW());
    END IF;

    -- Generate dynamic SQL to insert data into tblproduct_transaction_history from tblproduct_transaction
    SET @sql1 = CONCAT('INSERT INTO tblproduct_transaction_history (dateTime, user_fk, product_fk, product_name, ', @column_names, ') SELECT NOW(), product_pk AS user_fk, product_pk, product_name, ', @column_values, ' FROM tblproduct_transaction;');
    PREPARE stmt1 FROM @sql1;
    EXECUTE stmt1;
    DEALLOCATE PREPARE stmt1;
    
    -- Check if data with the same year and month already exists in tblproduct_sales_months_history
    SELECT COUNT(*) INTO existing_count_sales FROM tblproduct_sales_months_history WHERE YEAR(datetime) = YEAR(NOW()) AND MONTH(datetime) = MONTH(NOW());

    IF existing_count_sales > 0 THEN
        -- Delete existing data with the same year and month
        DELETE FROM tblproduct_sales_months_history WHERE YEAR(datetime) = YEAR(NOW()) AND MONTH(datetime) = MONTH(NOW());
    END IF;

    -- Generate dynamic SQL to insert data into tblproduct_sales_months_history from tblproduct_sales_months
    SET @sql2 = CONCAT('INSERT INTO tblproduct_sales_months_history (datetime, product_fk, January, February, March, April, May, June, July, August, September, October, November, December) SELECT NOW(), product_fk, January, February, March, April, May, June, July, August, September, October, November, December FROM tblproduct_sales_months;');
    PREPARE stmt2 FROM @sql2;
    EXECUTE stmt2;
    DEALLOCATE PREPARE stmt2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_department` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_department` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_department`(d_name VARCHAR(100))
BEGIN
		INSERT INTO `tbldepartment` (`department_name`)
		VALUES(d_name);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_Multiple_Checkbox` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_Multiple_Checkbox` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_Multiple_Checkbox`(department_pk INT, brands VARCHAR(100))
BEGIN
    -- Check if the record already exists
    IF NOT EXISTS (SELECT 1 FROM `tblproductadjustpermission` WHERE `department_fk` = department_pk AND `product_tran_name_str` = brands) THEN
        -- Insert the record
        INSERT INTO `tblproductadjustpermission` (`department_fk`, `product_tran_name_str`)
        VALUES (department_pk, brands);
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Insert_User` */

/*!50003 DROP PROCEDURE IF EXISTS  `Insert_User` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_User`(u_full_name varchar(100),u_log_name varchar(100), u_log_password varchar(100),u_level int ,u_department int)
BEGIN
		-- insert into user
		insert into `tbluser` (`user_full_name`,`user_log_name`,`user_log_password`,`user_level_fk`,`user_department_fk`)
		values(u_full_name,u_log_name,u_log_password,u_level,u_department);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_All_department` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_All_department` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_All_department`()
BEGIN
	select * from `tbldepartment` Order by department_pk desc;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_All_Transaction` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_All_Transaction` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_All_Transaction`()
BEGIN
		-- Drop 
		DROP TABLE IF EXISTS tbltmptransaction;
		-- Create the temporary table
		CREATE TEMPORARY TABLE tbltmptransaction AS
		SELECT
		  COLUMN_NAME AS department_name
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_NAME = 'tblproduct_transaction'
		  AND ORDINAL_POSITION >= 4; -- Start from the third column (dateTime is 1, ETA is 2, RMA is 3)
		-- Display the temporary table
		SELECT * FROM tbltmptransaction;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_All_User` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_All_User` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_All_User`()
BEGIN
		select * from `tbluser`;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_Product_Data` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_Product_Data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_Product_Data`(lm int )
BEGIN
		select * from `tblproduct_transaction` where `product_status` = 1 limit lm; 
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Load_Report_Data` */

/*!50003 DROP PROCEDURE IF EXISTS  `Load_Report_Data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Load_Report_Data`(IN input_month VARCHAR(100), IN input_year VARCHAR(100))
BEGIN
    DECLARE start_date DATETIME;
    DECLARE end_date DATETIME;
    
    IF input_month IS NULL AND input_year IS NULL THEN
        SET start_date = (SELECT MIN(`datetime`) FROM tblproduct_transaction_history);
        SET end_date = (SELECT MAX(`datetime`) FROM tblproduct_transaction_history);
    ELSE
        SET start_date = STR_TO_DATE(CONCAT(input_year, '-', input_month, '-01'), '%Y-%m-%d');
        SET end_date = LAST_DAY(start_date);
    END IF;

    SELECT t1.*, t2.*
    FROM (
        SELECT DISTINCT *
        FROM tblproduct_transaction_history
        WHERE `datetime` BETWEEN start_date AND end_date
    ) AS t1
    INNER JOIN (
        SELECT DISTINCT * 
        FROM tblproduct_sales_months_history
        WHERE `datetime` BETWEEN start_date AND end_date
    ) AS t2 ON t1.product_fk = t2.product_fk AND t1.datetime = t2.datetime
    ORDER BY t1.datetime, t1.product_fk;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Product_Status` */

/*!50003 DROP PROCEDURE IF EXISTS  `Product_Status` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Product_Status`(IN department_id INT, IN new_status VARCHAR(255))
BEGIN
    UPDATE tbldepartment 
    SET product_status = new_status 
    WHERE department_pk = department_id;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_AddMonthsToTempTable` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_AddMonthsToTempTable` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_AddMonthsToTempTable`()
BEGIN
    DECLARE dynamic_year INT;
    DECLARE column_name VARCHAR(255);
    DECLARE col_counter INT DEFAULT 1;
    
    -- Set dynamic_year to the current year
    SET dynamic_year = YEAR(NOW());
    
    -- Drop the temporary table if it exists
    DROP TEMPORARY TABLE IF EXISTS temp_table;
    
    -- Create a temporary table
    CREATE TEMPORARY TABLE IF NOT EXISTS temp_table AS
    SELECT * FROM tblproduct_transaction;
    
    -- Construct the ALTER TABLE statement to add the new columns in reverse order (from December to January)
    SET col_counter = 12; -- Start from December
    WHILE col_counter >= 1 DO
        SET column_name = CONCAT(
            CASE col_counter
                WHEN 1 THEN 'January'
                WHEN 2 THEN 'February'
                WHEN 3 THEN 'March'
                WHEN 4 THEN 'April'
                WHEN 5 THEN 'May'
                WHEN 6 THEN 'June'
                WHEN 7 THEN 'July'
                WHEN 8 THEN 'August'
                WHEN 9 THEN 'September'
                WHEN 10 THEN 'October'
                WHEN 11 THEN 'November'
                WHEN 12 THEN 'December'
            END, '_', dynamic_year
        );
        -- Check if the column already exists before adding it
        SET @column_exists_query = CONCAT('SELECT COUNT(*) INTO @column_exists FROM information_schema.columns WHERE table_name = ''temp_table'' AND column_name = ''', column_name, ''';');
        PREPARE column_exists_stmt FROM @column_exists_query;
        EXECUTE column_exists_stmt;
        DEALLOCATE PREPARE column_exists_stmt;
        IF @column_exists = 0 THEN
            SET @alter_table_sql = CONCAT('ALTER TABLE temp_table ADD COLUMN ', column_name, ' INT DEFAULT 0;');
            PREPARE alter_table_stmt FROM @alter_table_sql;
            EXECUTE alter_table_stmt;
            DEALLOCATE PREPARE alter_table_stmt;
        END IF;
        -- Decrement the counter
        SET col_counter = col_counter - 1;
    END WHILE;
    
    -- Select and display data from the temporary table
    SELECT * FROM temp_table;
    
END */$$
DELIMITER ;

/* Procedure structure for procedure `update_table_column` */

/*!50003 DROP PROCEDURE IF EXISTS  `update_table_column` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `update_table_column`(IN p_name VARCHAR(150))
BEGIN
    DECLARE sum_columns TEXT;
    DECLARE sql_query TEXT;

    SET @sql = CONCAT('SELECT PT.*, (');

    -- Fetch column names starting from the specified index
    SELECT GROUP_CONCAT(CONCAT(column_name, ' + ') SEPARATOR '') INTO sum_columns
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE table_name = 'tblproduct_transaction'
    AND ordinal_position >= 4;

    -- Remove the last ' + ' from the concatenated sum
    SET sum_columns = LEFT(sum_columns, LENGTH(sum_columns) - 2);

    -- Construct the SELECT statement with the dynamically calculated sum and subtraction
    IF p_name = "" THEN
        SET @sql = CONCAT(@sql, sum_columns, ') AS Current_Stock, (', sum_columns, ') - (January + February + March + April + May + June + July + August + September + October + November + December) AS Total, PSM.`December`,PSM.`November`,PSM.`October`,PSM.`September`,PSM.`August`,PSM.`July`,PSM.`June`,PSM.`May`,PSM.`April`,PSM.`March`,PSM.`February`,PSM.`January` FROM tblproduct_transaction PT INNER JOIN tblproduct_sales_months PSM ON PT.product_pk = PSM.product_fk');
    ELSE
        SET @sql = CONCAT(@sql, sum_columns, ') AS Current_Stock, (', sum_columns, ') - (January + February + March + April + May + June + July + August + September + October + November + December) AS Total, PSM.`December`,PSM.`November`,PSM.`October`,PSM.`September`,PSM.`August`,PSM.`July`,PSM.`June`,PSM.`May`,PSM.`April`,PSM.`March`,PSM.`February`,PSM.`January` FROM tblproduct_transaction PT INNER JOIN tblproduct_sales_months PSM ON PT.product_pk = PSM.product_fk  WHERE PT.product_name LIKE ?');
    END IF;

    -- Prepare the statement
    PREPARE stmt FROM @sql;

    -- Execute the statement with the provided parameter
    IF p_name <> "" THEN
        SET @p_name = CONCAT('%', p_name, '%');
        EXECUTE stmt USING @p_name;
    ELSE
        EXECUTE stmt;
    END IF;

    -- Deallocate the prepared statement
    DEALLOCATE PREPARE stmt;
END */$$
DELIMITER ;

/* Procedure structure for procedure `User_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `User_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `User_login`( userName varchar(100) , pass_word VARCHAR(100))
BEGIN		
		select * from `tbluser` where `user_log_name` = userName and `user_log_password` = pass_word ;	 
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
