/*
SQLyog Ultimate - MySQL GUI v8.2 
MySQL - 5.0.24a-community-nt : Database - mqcpi_one
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mqcpi_one` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mqcpi_one`;

/*Table structure for table `tbl_contract` */

DROP TABLE IF EXISTS `tbl_contract`;

CREATE TABLE `tbl_contract` (
  `id` int(11) default NULL,
  `Contract_ID` varchar(50) default NULL,
  `Coontract_Name` varchar(100) default NULL,
  `Contract_File` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_contract` */

/*Table structure for table `tbl_crew` */

DROP TABLE IF EXISTS `tbl_crew`;

CREATE TABLE `tbl_crew` (
  `id` int(11) NOT NULL auto_increment,
  `Crew_ID` varchar(50) default NULL,
  `Last_Name` varchar(50) default NULL,
  `First_Name` varchar(50) default NULL,
  `Middle_Name` varchar(50) default NULL,
  `Birthday` date default NULL,
  `Age` int(11) default NULL,
  `Email_Address` varchar(100) default NULL,
  `Home_Address` varchar(100) default NULL,
  `In_Case_LastName` varchar(100) default NULL,
  `In_Case_FirstName` varchar(100) default NULL,
  `In_Case_MiddleName` varchar(100) default NULL,
  `In_Case_Relationship` varchar(100) default NULL,
  `Mobile_Number` varchar(50) default NULL,
  `Rank_ID` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_crew` */

insert  into `tbl_crew`(`id`,`Crew_ID`,`Last_Name`,`First_Name`,`Middle_Name`,`Birthday`,`Age`,`Email_Address`,`Home_Address`,`In_Case_LastName`,`In_Case_FirstName`,`In_Case_MiddleName`,`In_Case_Relationship`,`Mobile_Number`,`Rank_ID`) values (1,'CRW-000-001','Calo','Rose Ann','Tabios','0000-00-00',21,'cal@yahoo.com','San Basilio',NULL,NULL,NULL,NULL,'0989778676','001');

/*Table structure for table `tbl_duty` */

DROP TABLE IF EXISTS `tbl_duty`;

CREATE TABLE `tbl_duty` (
  `id` int(11) default NULL,
  `Duty_ID` varchar(50) default NULL,
  `Duty_Description` char(255) default NULL,
  `Rank_ID` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_duty` */

insert  into `tbl_duty`(`id`,`Duty_ID`,`Duty_Description`,`Rank_ID`) values (1,'DUTY-2021-001','Hsshg','001');

/*Table structure for table `tbl_eta` */

DROP TABLE IF EXISTS `tbl_eta`;

CREATE TABLE `tbl_eta` (
  `id` int(11) default NULL,
  `Eta_ID` varchar(50) default NULL,
  `Shipment_ID` varchar(50) default NULL,
  `Current_Latitude` varchar(50) default NULL,
  `Current_Longitude` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_eta` */

/*Table structure for table `tbl_id` */

DROP TABLE IF EXISTS `tbl_id`;

CREATE TABLE `tbl_id` (
  `id` int(11) NOT NULL auto_increment,
  `Count` int(12) default NULL,
  `Table` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_id` */

insert  into `tbl_id`(`id`,`Count`,`Table`) values (1,5,'User'),(2,3,'Department'),(3,8,'User Type'),(4,7,'Position'),(5,7,'Employee'),(6,44,'Attendance'),(7,3,'Schedule'),(8,1,'Overtime'),(9,0,NULL),(10,0,NULL);

/*Table structure for table `tbl_ranks` */

DROP TABLE IF EXISTS `tbl_ranks`;

CREATE TABLE `tbl_ranks` (
  `id` int(11) default NULL,
  `Rank_ID` varchar(100) default NULL,
  `Rank_Type` varchar(100) default NULL,
  `Count` int(11) default NULL,
  `Qty` int(11) default NULL,
  `Contract_ID` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ranks` */

/*Table structure for table `tbl_route` */

DROP TABLE IF EXISTS `tbl_route`;

CREATE TABLE `tbl_route` (
  `id` int(11) default NULL,
  `Route_ID` varchar(50) default NULL,
  `Destination` text,
  `Latitude` varchar(50) default NULL,
  `Longitute` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_route` */

/*Table structure for table `tbl_shipment_crew` */

DROP TABLE IF EXISTS `tbl_shipment_crew`;

CREATE TABLE `tbl_shipment_crew` (
  `id` int(11) default NULL,
  `Shipment_ID` varchar(50) default NULL,
  `Crew_ID` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_shipment_crew` */

/*Table structure for table `tbl_shipping` */

DROP TABLE IF EXISTS `tbl_shipping`;

CREATE TABLE `tbl_shipping` (
  `id` int(11) default NULL,
  `Shipping_ID` varchar(50) default NULL,
  `Route_ID` varchar(50) default NULL,
  `Shipping_Destination` varchar(100) default NULL,
  `Shipping_Recipient` varchar(100) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_shipping` */

insert  into `tbl_shipping`(`id`,`Shipping_ID`,`Route_ID`,`Shipping_Destination`,`Shipping_Recipient`) values (1,'SHP-2020-001','RT-2020-001','Porac','Carissa');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(15) NOT NULL auto_increment,
  `User_ID` varchar(50) default NULL,
  `Last_Name` varchar(50) default NULL,
  `First_Name` varchar(50) default NULL,
  `Middle_Name` varchar(50) default NULL,
  `Gender` varchar(50) default NULL,
  `Email_Address` varchar(50) default NULL,
  `User_Name` varchar(50) default NULL,
  `Password` varchar(50) default NULL,
  `Type_ID` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`User_ID`,`Last_Name`,`First_Name`,`Middle_Name`,`Gender`,`Email_Address`,`User_Name`,`Password`,`Type_ID`) values (1,'USR-2012-0001','Baluyut','Jerome','Carreon','','jbaluyut@geos.work','jbaluyut@geos.work','default','TYP-2021-0001'),(2,'USR-2021-0002','Di Magkamali1','Perfecto','Mahusay1','Female','perf@yahoo.com','perf@yahoo.com','default','TYP-2021-0005'),(3,'USR-2021-0003','Di Matulac','Dabiana','Hebili','Male','debi@yahoo.com','debi@yahoo.com','default','TYP-2021-0005');

/*Table structure for table `tbl_user_type` */

DROP TABLE IF EXISTS `tbl_user_type`;

CREATE TABLE `tbl_user_type` (
  `id` int(15) NOT NULL auto_increment,
  `Type_ID` varchar(50) default NULL,
  `Type_Name` varchar(50) default NULL,
  `Type_Description` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_type` */

insert  into `tbl_user_type`(`id`,`Type_ID`,`Type_Name`,`Type_Description`) values (1,'TYP-2021-0001','Super Administrator','System Super Administrator'),(5,'TYP-2021-0005','IT Supervisor','Information Technology Supervisor'),(11,'TYP-2021-0007','IT Project Manager','Project Manager');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
