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

/*Table structure for table `tbldepartment` */

DROP TABLE IF EXISTS `tbldepartment`;

CREATE TABLE `tbldepartment` (
  `department_pk` int(11) NOT NULL AUTO_INCREMENT,
  `active_status` int(11) DEFAULT '0' COMMENT '1=Active, 0=InActive',
  `department_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `product_status` int(11) DEFAULT '0' COMMENT '1=Active, 0=InActive',
  PRIMARY KEY (`department_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbldepartment` */

insert  into `tbldepartment`(`department_pk`,`active_status`,`department_name`,`product_status`) values 
(1,1,'Stock',0),
(2,1,'Marketing',0),
(3,1,'Admin',0),
(4,1,'Sale',0);

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
(8,0,0,0,0,0,0,0,0,0,0,0,0);

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
('2024-05-27 13:59:21',1,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',2,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',3,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',4,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',5,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',6,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',7,0,0,0,0,0,0,0,0,0,0,0,0),
('2024-05-27 13:59:21',8,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `tblproduct_transaction` */

DROP TABLE IF EXISTS `tblproduct_transaction`;

CREATE TABLE `tblproduct_transaction` (
  `product_pk` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_fk` int(11) DEFAULT NULL,
  `product_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `PK_CI` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `ETD` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `ETA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `STOCK_AVAILABLE` int(11) DEFAULT '0',
  `SHOWS` int(11) DEFAULT '0',
  PRIMARY KEY (`product_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction` */

insert  into `tblproduct_transaction`(`product_pk`,`product_type_fk`,`product_name`,`PK_CI`,`ETD`,`RMA`,`ETA`,`Consignment_Stock`,`STOCK_AVAILABLE`,`SHOWS`) values 
(1,1,'TP-Link 01','P80',0,0,0,0,0,0),
(2,1,'TP-Link 02','P90',0,0,0,0,0,0),
(3,1,'TP-Link 03','P100',0,0,0,0,0,0),
(4,1,'TP-Link 04','0',0,0,0,0,0,0),
(5,2,'Deco 01','0',0,0,0,0,0,0),
(6,2,'Deco 02','0',0,0,0,0,0,0),
(7,2,'Deco 03','0',0,0,0,0,0,0),
(8,2,'Deco 04','0',0,0,0,0,0,0);

/*Table structure for table `tblproduct_transaction_history` */

DROP TABLE IF EXISTS `tblproduct_transaction_history`;

CREATE TABLE `tblproduct_transaction_history` (
  `user_fk` int(11) DEFAULT NULL,
  `product_fk` int(11) DEFAULT NULL,
  `product_type_fk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PK_CI` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateTime` timestamp NULL DEFAULT NULL,
  `ETD` int(11) DEFAULT '0',
  `RMA` int(11) DEFAULT '0',
  `ETA` int(11) DEFAULT '0',
  `Consignment_Stock` int(11) DEFAULT '0',
  `STOCK_AVAILABLE` int(11) DEFAULT '0',
  `SHOWS` int(11) DEFAULT '0',
  KEY `user_fk` (`user_fk`),
  KEY `product_fk` (`product_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_transaction_history` */

insert  into `tblproduct_transaction_history`(`user_fk`,`product_fk`,`product_type_fk`,`product_name`,`PK_CI`,`dateTime`,`ETD`,`RMA`,`ETA`,`Consignment_Stock`,`STOCK_AVAILABLE`,`SHOWS`) values 
(1,1,'1','TP-Link 01','P80','2024-05-27 13:59:21',0,0,0,0,0,0),
(2,2,'1','TP-Link 02','P90','2024-05-27 13:59:21',0,0,0,0,0,0),
(3,3,'1','TP-Link 03','0','2024-05-27 13:59:21',0,0,0,0,0,0),
(4,4,'1','TP-Link 04','0','2024-05-27 13:59:21',0,0,0,0,0,0),
(5,5,'2','Deco 01','0','2024-05-27 13:59:21',0,0,0,0,0,0),
(6,6,'2','Deco 02','0','2024-05-27 13:59:21',0,0,0,0,0,0),
(7,7,'2','Deco 03','0','2024-05-27 13:59:21',0,0,0,0,0,0),
(8,8,'2','Deco 04','0','2024-05-27 13:59:21',0,0,0,0,0,0);

/*Table structure for table `tblproduct_type` */

DROP TABLE IF EXISTS `tblproduct_type`;

CREATE TABLE `tblproduct_type` (
  `product_type_pk` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_type_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblproduct_type` */

insert  into `tblproduct_type`(`product_type_pk`,`product_type_name`) values 
(1,'TP-Link'),
(2,'Deco');

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
(1,'ETD'),
(1,'ETA'),
(2,'SHOWS'),
(2,'Consignment_Stock'),
(2,'STOCK_AVAILABLE');

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
(2,1,2,'RY DARA','Dara','123'),
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Load_Report_Data`()
BEGIN
    SELECT t1.*, t2.*
    FROM tblproduct_transaction_history AS t1
    INNER JOIN tblproduct_sales_months_history AS t2 
    ON t1.product_fk = t2.product_fk AND t1.datetime = t2.datetime
    ORDER BY t1.datetime, t1.product_fk;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Product_Status` */

/*!50003 DROP PROCEDURE IF EXISTS  `Product_Status` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Product_Status`(IN department_id INT, IN new_status int)
BEGIN
    UPDATE tbldepartment 
    SET active_status = new_status 
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `update_table_column`(
    IN `p_name` VARCHAR(150),
    IN `p_type` INT
)
BEGIN
    DECLARE sum_columns TEXT;
    DECLARE sql_query TEXT;

    -- Set the initial value of sql_query
    SET sql_query = CONCAT('SELECT PT.*, (');

    -- Fetch column names starting from the specified index, excluding product_status, PK_CI, product_name, and RMA
    SELECT GROUP_CONCAT(
         CONCAT(column_name, ' + ') SEPARATOR ''
    ) INTO sum_columns
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE table_name = 'tblproduct_transaction'
    AND ordinal_position >= 4
    AND column_name NOT IN ('product_status','PK_CI','product_name', 'RMA','ETD');

    -- Remove the last ' + ' from the concatenated sum
    SET sum_columns = LEFT(sum_columns, LENGTH(sum_columns) - 2);

    -- Construct the SELECT statement with the dynamically calculated sum and subtraction of RMA
    SET @sql_query = CONCAT(
        sql_query, 
        sum_columns, 
        ')- RMA AS Current_Stock, PSM.`December`, PSM.`November`, PSM.`October`, PSM.`September`, PSM.`August`, PSM.`July`, PSM.`June`, PSM.`May`, PSM.`April`, PSM.`March`, PSM.`February`, PSM.`January` FROM tblproduct_transaction PT INNER JOIN tblproduct_sales_months PSM ON PT.product_pk = PSM.product_fk'
    );

    -- Add conditions based on the input parameters
    IF p_name <> '' AND p_type IS NOT NULL THEN
        SET @sql_query = CONCAT(@sql_query, ' WHERE PT.product_name LIKE ? AND PT.product_type_fk = ?');
    ELSEIF p_name <> '' THEN
        SET @sql_query = CONCAT(@sql_query, ' WHERE PT.product_name LIKE ?');
    ELSEIF p_type IS NOT NULL THEN
        SET @sql_query = CONCAT(@sql_query, ' WHERE PT.product_type_fk = ?');
    END IF;

    -- Prepare the statement
    PREPARE stmt FROM @sql_query;

    -- Execute the statement with the provided parameters
    IF p_name <> '' AND p_type IS NOT NULL THEN
        SET @p_name = CONCAT('%', p_name, '%');
        SET @p_type = p_type;
        EXECUTE stmt USING @p_name, @p_type;
    ELSEIF p_name <> '' THEN
        SET @p_name = CONCAT('%', p_name, '%');
        EXECUTE stmt USING @p_name;
    ELSEIF p_type IS NOT NULL THEN
        SET @p_type = p_type;
        EXECUTE stmt USING @p_type;
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
