/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.7.9 : Database - apartment_management
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`apartment_management` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `apartment_management`;

/*Table structure for table `appointment` */

DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `appointment` */

insert  into `appointment`(`appointment_id`,`hospital_id`,`user_id`,`date`,`time`,`details`,`status`) values 
(1,1,2,'2022/12/14','6646','hsijwjwjqk','Accept'),
(2,1,2,'2022/12/14','15:29','dfghjkl','pending'),
(3,1,2,'2022/12/14','8:30','fiknhu','Accept');

/*Table structure for table `complaint` */

DROP TABLE IF EXISTS `complaint`;

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `complaint` varchar(100) DEFAULT NULL,
  `reply` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `complaint` */

insert  into `complaint`(`complaint_id`,`user_id`,`complaint`,`reply`,`date`) values 
(1,2,'jaj','ok','2022-12-14'),
(2,2,'jajhhs','pending','2022-12-14'),
(3,2,'jajhhs','pending','2022-12-14'),
(4,2,'hai','pending','2022-12-14'),
(5,2,'bjj','yes','2022-12-14'),
(6,1,'jsn','pending','2022-12-14'),
(7,1,'ha','pending','2022-12-14');

/*Table structure for table `hospital` */

DROP TABLE IF EXISTS `hospital`;

CREATE TABLE `hospital` (
  `hospital_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) DEFAULT NULL,
  `hospital_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `hospital` */

insert  into `hospital`(`hospital_id`,`login_id`,`hospital_name`,`phone`,`email`,`place`) values 
(1,3,'hospital','2345678907','hos@gmail.com','kochi');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`login_id`,`username`,`password`,`usertype`) values 
(1,'shop','shop','Shop'),
(2,'service','service','Service'),
(3,'hospital','hospital','Hospital'),
(4,'admin','admin','admin'),
(8,'hello','hello','User'),
(6,'hai','hai','User'),
(7,'renu','renu','User');

/*Table structure for table `order_child` */

DROP TABLE IF EXISTS `order_child`;

CREATE TABLE `order_child` (
  `orderchild_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordermaster_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`orderchild_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `order_child` */

insert  into `order_child`(`orderchild_id`,`ordermaster_id`,`product_id`,`qty`,`price`) values 
(1,1,1,'10','250'),
(2,2,3,'1','5000');

/*Table structure for table `order_master` */

DROP TABLE IF EXISTS `order_master`;

CREATE TABLE `order_master` (
  `ordermaster_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ordermaster_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `order_master` */

insert  into `order_master`(`ordermaster_id`,`user_id`,`shop_id`,`date`,`total`,`status`) values 
(1,2,1,'2022-12-14','2500','Paid'),
(2,2,1,'2022-12-14','5000','Paid');

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordermaster_id` int(11) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

insert  into `payment`(`payment_id`,`ordermaster_id`,`amount`,`date`) values 
(1,1,'2500','2022-12-14'),
(2,1,'2','pending'),
(3,1,'2','pending'),
(4,2,'5000','2022-12-15');

/*Table structure for table `precaution` */

DROP TABLE IF EXISTS `precaution`;

CREATE TABLE `precaution` (
  `precaution_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) DEFAULT NULL,
  `precaution` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`precaution_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `precaution` */

insert  into `precaution`(`precaution_id`,`appointment_id`,`precaution`,`description`) values 
(1,1,'precuation','descriptions..........'),
(2,3,'asdfgh','descriptions..........');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`product_id`,`shop_id`,`product_name`,`quantity`,`price`,`image`) values 
(3,1,'renuka','2','5000','image/image_6399b01c9c919.jpg'),
(1,1,'product2','1000','250','image/image_6396ed8fc7b7f.jfif');

/*Table structure for table `request` */

DROP TABLE IF EXISTS `request`;

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `request` */

insert  into `request`(`request_id`,`service_id`,`user_id`,`status`) values 
(1,1,2,'Accept'),
(2,1,2,'Accept');

/*Table structure for table `service` */

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) DEFAULT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `service` */

insert  into `service`(`service_id`,`login_id`,`service_name`,`phone`,`description`) values 
(1,2,'service name','ernakulam','details');

/*Table structure for table `shop` */

DROP TABLE IF EXISTS `shop`;

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) DEFAULT NULL,
  `shop_name` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `shop` */

insert  into `shop`(`shop_id`,`login_id`,`shop_name`,`place`,`landmark`,`phone`,`email`) values 
(1,1,'Shophouse','tvm','10 km away from tvm city','2345678907','shop@gmail.com');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`login_id`,`fname`,`lname`,`place`,`email`,`phone`,`address`) values 
(1,6,'user','user','ernakulam','user@gmail.com','1234567890','wrdghgdahd heiuwh'),
(2,7,'renu','ka','Ernakulam ','renuka12@gmail.com','461946187','tveushjqjq'),
(3,8,'hello','helli','chick','aFuzhou@gmail.com','4539841239','clutch form Gothic koodnud');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
