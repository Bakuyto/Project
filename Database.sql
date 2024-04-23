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
  PRIMARY KEY (`department_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbldepartment` */

insert  into `tbldepartment`(`department_pk`,`department_name`) values 
(1,'Stock'),
(2,'Sale'),
(3,'Account'),
(4,'Admin'),
(5,'Marketing'),
(6,'Super Admin');

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
(30,0,0,0,0,0,0,0,0,0,0,0,0),
(31,0,0,0,0,0,0,0,0,0,0,0,0),
(32,0,0,0,0,0,0,0,0,0,0,0,0),
(33,0,0,0,0,0,0,0,0,0,0,0,0),
(34,0,0,0,0,0,0,0,0,0,0,0,0),
(35,0,0,0,0,0,0,0,0,0,0,0,0),
(36,0,0,0,0,0,0,0,0,0,0,0,0),
(37,0,0,0,0,0,0,0,0,0,0,0,0),
(38,0,0,0,0,0,0,0,0,0,0,0,0),
(39,0,0,0,0,0,0,0,0,0,0,0,0),
(40,0,0,0,0,0,0,0,0,0,0,0,0),
(41,0,0,0,0,0,0,0,0,0,0,0,0),
(42,0,0,0,0,0,0,0,0,0,0,0,0),
(43,0,0,0,0,0,0,0,0,0,0,0,0),
(44,0,0,0,0,0,0,0,0,0,0,0,0),
(45,0,0,0,0,0,0,0,0,0,0,0,0),
(46,0,0,0,0,0,0,0,0,0,0,0,0),
(47,0,0,0,0,0,0,0,0,0,0,0,0),
(48,0,0,0,0,0,0,0,0,0,0,0,0),
(49,0,0,0,0,0,0,0,0,0,0,0,0),
(50,0,0,0,0,0,0,0,0,0,0,0,0),
(51,0,0,0,0,0,0,0,0,0,0,0,0),
(52,0,0,0,0,0,0,0,0,0,0,0,0),
(53,0,0,0,0,0,0,0,0,0,0,0,0),
(54,0,0,0,0,0,0,0,0,0,0,0,0),
(55,0,0,0,0,0,0,0,0,0,0,0,0),
(56,0,0,0,0,0,0,0,0,0,0,0,0),
(57,0,0,0,0,0,0,0,0,0,0,0,0),
(58,0,0,0,0,0,0,0,0,0,0,0,0),
(59,0,0,0,0,0,0,0,0,0,0,0,0),
(60,0,0,0,0,0,0,0,0,0,0,0,0),
(61,0,0,0,0,0,0,0,0,0,0,0,0),
(62,0,0,0,0,0,0,0,0,0,0,0,0),
(63,0,0,0,0,0,0,0,0,0,0,0,0),
(64,0,0,0,0,0,0,0,0,0,0,0,0),
(65,0,0,0,0,0,0,0,0,0,0,0,0),
(66,0,0,0,0,0,0,0,0,0,0,0,0),
(67,0,0,0,0,0,0,0,0,0,0,0,0),
(68,0,0,0,0,0,0,0,0,0,0,0,0),
(69,0,0,0,0,0,0,0,0,0,0,0,0),
(70,0,0,0,0,0,0,0,0,0,0,0,0),
(71,0,0,0,0,0,0,0,0,0,0,0,0),
(72,0,0,0,0,0,0,0,0,0,0,0,0),
(73,0,0,0,0,0,0,0,0,0,0,0,0),
(74,0,0,0,0,0,0,0,0,0,0,0,0),
(75,0,0,0,0,0,0,0,0,0,0,0,0),
(76,0,0,0,0,0,0,0,0,0,0,0,0),
(77,0,0,0,0,0,0,0,0,0,0,0,0),
(78,0,0,0,0,0,0,0,0,0,0,0,0),
(79,0,0,0,0,0,0,0,0,0,0,0,0),
(80,0,0,0,0,0,0,0,0,0,0,0,0),
(81,0,0,0,0,0,0,0,0,0,0,0,0),
(82,0,0,0,0,0,0,0,0,0,0,0,0),
(83,0,0,0,0,0,0,0,0,0,0,0,0),
(84,0,0,0,0,0,0,0,0,0,0,0,0),
(85,0,0,0,0,0,0,0,0,0,0,0,0),
(86,0,0,0,0,0,0,0,0,0,0,0,0),
(87,0,0,0,0,0,0,0,0,0,0,0,0),
(88,0,0,0,0,0,0,0,0,0,0,0,0),
(89,0,0,0,0,0,0,0,0,0,0,0,0),
(90,0,0,0,0,0,0,0,0,0,0,0,0),
(91,0,0,0,0,0,0,0,0,0,0,0,0),
(92,0,0,0,0,0,0,0,0,0,0,0,0),
(93,0,0,0,0,0,0,0,0,0,0,0,0),
(94,0,0,0,0,0,0,0,0,0,0,0,0),
(95,0,0,0,0,0,0,0,0,0,0,0,0),
(96,0,0,0,0,0,0,0,0,0,0,0,0),
(97,0,0,0,0,0,0,0,0,0,0,0,0),
(98,0,0,0,0,0,0,0,0,0,0,0,0),
(99,0,0,0,0,0,0,0,0,0,0,0,0),
(100,0,0,0,0,0,0,0,0,0,0,0,0),
(101,0,0,0,0,0,0,0,0,0,0,0,0),
(102,0,0,0,0,0,0,0,0,0,0,0,0),
(103,0,0,0,0,0,0,0,0,0,0,0,0),
(104,0,0,0,0,0,0,0,0,0,0,0,0),
(105,0,0,0,0,0,0,0,0,0,0,0,0),
(106,0,0,0,0,0,0,0,0,0,0,0,0),
(107,0,0,0,0,0,0,0,0,0,0,0,0),
(108,0,0,0,0,0,0,0,0,0,0,0,0),
(109,0,0,0,0,0,0,0,0,0,0,0,0),
(110,0,0,0,0,0,0,0,0,0,0,0,0),
(111,0,0,0,0,0,0,0,0,0,0,0,0),
(112,0,0,0,0,0,0,0,0,0,0,0,0),
(113,0,0,0,0,0,0,0,0,0,0,0,0),
(114,0,0,0,0,0,0,0,0,0,0,0,0),
(115,0,0,0,0,0,0,0,0,0,0,0,0),
(116,0,0,0,0,0,0,0,0,0,0,0,0),
(117,0,0,0,0,0,0,0,0,0,0,0,0),
(118,0,0,0,0,0,0,0,0,0,0,0,0),
(119,0,0,0,0,0,0,0,0,0,0,0,0),
(120,0,0,0,0,0,0,0,0,0,0,0,0),
(121,0,0,0,0,0,0,0,0,0,0,0,0),
(122,0,0,0,0,0,0,0,0,0,0,0,0),
(123,0,0,0,0,0,0,0,0,0,0,0,0),
(124,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `tblproduct_sales_months_history` */

DROP TABLE IF EXISTS `tblproduct_sales_months_history`;

CREATE TABLE `tblproduct_sales_months_history` (
  `datetime` timestamp NULL DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `January` int(11) DEFAULT '0',
  `Fabruary` int(11) DEFAULT '0',
  `March` int(11) DEFAULT '0',
  `April` int(11) DEFAULT '0',
  `May` int(11) DEFAULT '0',
  `June` int(11) DEFAULT '0',
  `July` int(11) DEFAULT '0',
  `August` int(11) DEFAULT '0',
  `September` int(11) DEFAULT '0',
  `October` int(11) DEFAULT '0',
  `Nevember` int(11) DEFAULT '0',
  `December` int(11) DEFAULT '0',
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_sales_months_history` */

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
  `Product` int(11) DEFAULT '0',
  PRIMARY KEY (`product_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction` */

insert  into `tblproduct_transaction`(`product_pk`,`product_name`,`product_status`,`ETA`,`RMA`,`Consignment_Stock`,`Pre_Order`,`Product`) values 
(1,'Naraka',1,0,0,0,0,0),
(2,'Mesa',1,0,0,0,0,0),
(3,'bopha',1,0,0,0,0,0),
(4,'Masha',1,0,0,0,0,0),
(5,'Taka',1,0,0,0,0,0),
(6,'Messi',1,0,0,0,0,0),
(7,'Ronaldo',1,0,0,0,0,0),
(8,'Dora',1,0,0,0,0,0),
(9,'Battle',1,0,0,0,0,0),
(10,'Tazong',1,0,0,0,0,0),
(11,'Razer',1,0,0,0,0,0),
(12,'Flutter',1,0,0,0,0,0),
(13,'React',1,0,0,3,0,0),
(14,'Node.js',1,0,0,4,0,0),
(15,'PHP',1,0,0,0,0,0),
(16,'HTML',1,0,0,0,0,0),
(17,'Bootstrap',1,0,0,0,0,0),
(18,'Javascript',1,0,0,0,0,0),
(19,'Java',1,0,0,0,0,0),
(20,'C#',1,0,0,0,0,0),
(21,'Web Developer',1,0,0,0,0,0),
(22,'Software Developer',1,0,0,0,0,0),
(23,'Forex',1,0,0,0,0,0),
(24,'sting',1,0,0,0,0,0),
(25,'sting1',1,0,0,0,0,0),
(26,'Coca',1,0,0,0,0,0),
(27,'Fanta',1,0,0,0,0,0),
(28,'Coffee',1,0,0,0,0,0),
(29,'Coffeeee',1,0,0,0,0,0),
(30,'Benfica',1,0,0,0,0,0),
(31,'Liverpool',1,0,0,0,0,0),
(32,'Chelsea',1,0,0,0,0,0),
(33,'Saga',1,0,0,0,0,0),
(34,'Vespa',1,0,0,0,0,0),
(35,'Plata',1,0,0,0,0,0),
(36,'Bosba',1,0,0,0,0,0),
(37,'Zamba',1,0,0,0,0,0),
(38,'Zamba II',1,0,0,0,0,0),
(39,'Leonardo',1,0,0,0,0,0),
(40,'Leonardo II',1,0,0,0,0,0),
(41,'Honda',1,0,0,0,0,0),
(42,'Suzuki',1,0,0,0,0,0),
(43,'Ducati',1,0,0,0,0,0),
(44,'Ducati',1,0,0,0,0,0),
(45,'Ducati',1,0,0,0,0,0),
(46,'Ducati II',1,0,0,0,0,0),
(47,'Neymar',1,0,0,0,0,0),
(48,'Halal',1,0,0,0,0,0),
(49,'Asernal',1,0,0,0,0,0),
(50,'Asernal II',1,0,0,0,0,0),
(51,'Asernal IIII',1,0,0,0,0,0),
(52,'Kairi',1,0,0,0,0,0),
(53,'CW',1,0,0,0,0,0),
(54,'Kiboy',1,0,0,0,0,0),
(55,'Saka',1,0,0,0,0,0),
(56,'Mata',1,0,0,0,0,0),
(57,'Donut',1,100,10,0,0,0),
(58,'Spider Man',1,0,0,0,0,0),
(59,'Doctor Strange',1,0,0,0,0,0),
(60,'Shazam',1,0,0,0,0,0),
(61,'Loki',1,0,0,0,0,0),
(62,'Wonder Woman',1,0,0,0,0,0),
(63,'1111',1,0,0,0,0,0),
(64,'Zlatan',1,0,0,0,0,0),
(65,'Ronney',1,0,0,0,0,0),
(66,'CR7',1,0,0,0,0,0),
(67,'Maradona',1,0,0,0,0,0),
(68,'Donkey',1,0,0,0,0,0),
(69,'Donkey 2',1,0,0,0,0,0),
(70,'Rizzy',1,0,0,0,0,0),
(71,'Rizzy',1,0,0,0,0,0),
(72,'Rizzy',1,0,0,0,0,0),
(73,'Frozen',1,0,0,0,0,0),
(74,'Jorta',1,0,0,0,0,0),
(75,'2222',1,0,0,0,0,0),
(76,'asdf',1,0,0,0,0,0),
(77,'33',1,0,0,0,0,0),
(78,'1',1,0,0,0,0,0),
(79,'22',1,0,0,0,0,0),
(80,'123',1,0,0,0,0,0),
(81,'1234',1,0,0,0,0,0),
(82,'Taki',1,0,0,0,0,0),
(83,'1',1,0,0,0,0,0),
(84,'ad',1,0,0,0,0,0),
(85,'adfa',1,0,0,0,0,0),
(86,'America',1,0,0,0,0,0),
(87,'Meta',1,0,0,0,0,0),
(88,'Barbie',1,0,0,0,0,0),
(89,'Facebook',1,0,0,0,0,0),
(90,'Phnom Penh',1,0,0,0,0,0),
(91,'0',1,0,0,0,0,0),
(92,'0',1,0,0,0,0,0),
(93,'Lazer',1,0,0,0,0,0),
(94,'0',1,0,0,0,0,0),
(95,'0',1,0,0,0,0,0),
(96,'0',1,0,0,0,0,0),
(97,'aaa',0,0,0,0,0,0),
(98,'C2',0,0,0,0,0,0),
(99,'C3',0,0,0,0,0,0),
(100,'c4',0,0,0,0,0,0),
(101,'0',1,0,0,0,0,0),
(102,'0',1,0,0,0,0,0),
(103,'0',1,0,0,0,0,0),
(104,'0',1,0,0,0,0,0),
(105,'AAA',1,0,0,0,0,0),
(106,'0',1,0,0,0,0,0),
(107,'MF',1,0,0,0,0,0),
(108,'BattleGround',1,0,0,0,0,0),
(109,'Battle Ground',1,0,0,0,0,0),
(110,'Dota',1,0,0,0,0,0),
(111,'Dato',1,0,0,0,0,0),
(112,'0',1,0,0,0,0,0),
(113,'0',1,0,0,0,0,0),
(114,'0',1,0,0,0,0,0),
(115,'Fuiya',1,0,0,0,0,0),
(116,'Apex Legend',1,0,0,0,0,0),
(117,'Manga',1,0,0,0,0,0),
(118,'Overwatch 2',1,0,0,0,0,0),
(119,'Redragon',1,0,0,0,0,0),
(120,'God',1,0,0,0,0,0),
(121,'Brother',1,0,0,0,0,0),
(122,'Sister',1,0,0,0,0,0),
(123,'Grandpa',1,0,0,0,0,0),
(124,'Grandma',1,0,0,0,0,0);

/*Table structure for table `tblproduct_transaction_history` */

DROP TABLE IF EXISTS `tblproduct_transaction_history`;

CREATE TABLE `tblproduct_transaction_history` (
  `user_fk` int(11) DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `dateTime` timestamp NULL DEFAULT NULL,
  `ETA` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `Show_Room` int(11) DEFAULT '0',
  `Pre_Order` int(11) DEFAULT '0',
  `Product` int(11) DEFAULT '0',
  KEY `user_fk` (`user_fk`),
  KEY `product_fk` (`product_fk`),
  CONSTRAINT `tblproduct_transaction_history_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `tbluser` (`user_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction_history` */

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
(2,'RMA'),
(2,'Consignment_Stock'),
(6,'RMA'),
(6,'Consignment_Stock'),
(6,'RMA'),
(6,'Consignment_Stock');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbluser` */

insert  into `tbluser`(`user_pk`,`user_department_fk`,`user_level_fk`,`user_full_name`,`user_log_name`,`user_log_password`) values 
(23,6,1,'heng','heng','123'),
(24,6,1,'dolla','dolla','123'),
(25,6,1,'Hello','hello','123'),
(27,6,2,'dara','Ry Dara','123'),
(28,6,1,'Benny','Benny','123'),
(29,6,1,'Kaka','Kaka','123'),
(30,6,1,'MengSUE','SUE','123'),
(31,6,2,'Mengsue','bro meng','123'),
(32,6,1,'John Cena','John Cena','123');

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
        -- Drop the column for tblproduct_transaction_history
        SET @query2 = CONCAT('ALTER TABLE `inventorymanagement`.`tblproduct_transaction_history` DROP COLUMN ', column_name , ';');
        PREPARE stmt2 FROM @query2;
        EXECUTE stmt2;
        DEALLOCATE PREPARE stmt2;
        
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

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Insert_Multiple_Checkbox`(department_pk INT,brands VARCHAR(100))
BEGIN
    -- insert into tblproductadjustpermission
    INSERT INTO `tblproductadjustpermission` (`department_fk`,`product_tran_name_str`)
    VALUES(department_pk,brands);
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
