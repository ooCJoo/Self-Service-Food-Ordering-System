/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 5.7.33-log : Database - fos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fos`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`price`,`category`,`photo`) values 
(2,'Chicken Shanghai',143.00,'Appetizer','chicken_shanghai.jpg'),
(3,'Tempura',243.00,'Appetizer','tempura.jpg'),
(4,'Chicken Sisig',247.00,'Sizzling','chicken_sisig.jpg'),
(5,'Tuna Sisig',247.00,'Sizzling','tuna_sisig.jpg'),
(6,'Gambas',260.00,'Sizzling','gambas.jpg'),
(7,'Lychee',105.00,'Fruit Tea','lychee.jpg'),
(8,'Blueberry',105.00,'Fruit Tea','blueberry.jpg'),
(9,'Lemon',105.00,'Fruit Tea','lemon juice.jpg'),
(10,'Sinigang Boneless Bangus',286.00,'Tinola & Sinigang','sinigang_bangus.jpg'),
(11,'Tinolang Boneless Bangus',286.00,'Tinola & Sinigang','tinolang_bangus.jpg'),
(12,'Garlic Stir Shrimp',247.00,'Seafood','garlic_shrimp.jpg'),
(13,'Chili Garlic Shrimp',247.00,'Seafood','chili garlic shrimp.jpg'),
(14,'Fried Chicken',221.00,'Chicken','fried_chicken.jpg'),
(15,'Garlic Chicken',260.00,'Chicken','garlic_chicken.jpg'),
(16,'Spicy Chicken Wings',260.00,'Chicken','spicy_chicken_wings.jpg'),
(17,'Plain Rice Platter',143.00,'Rice','rice_platter.jpg'),
(18,'Rice Cup',6000.00,'Rice','cup_rice.jpg'),
(19,'coke',40.00,'Other Drinks','coke.jpg');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `transaction_id` (`transaction_id`) USING BTREE,
  KEY `menu_id` (`menu_id`) USING BTREE,
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `orders` */

insert  into `orders`(`id`,`transaction_id`,`menu_id`,`quantity`) values 
(131,150,2,'2'),
(132,150,5,'3'),
(133,152,2,'2'),
(134,154,2,'2'),
(135,155,5,'2'),
(136,155,7,'1'),
(137,155,10,'3'),
(138,158,2,'3'),
(139,158,9,'3'),
(142,160,2,'2'),
(143,161,2,'0'),
(144,161,2,'2'),
(145,161,3,'1');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `paymentstatus` varchar(255) DEFAULT NULL,
  `foodserve` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`status`,`total`,`datetime`,`paymentstatus`,`foodserve`,`user_id`) values 
(150,'Success',1027.00,'2021-05-18 00:26:23','Payment Received','Served',3),
(151,'Cancelled Order',0.00,'2021-05-18 00:29:01',NULL,NULL,NULL),
(152,'Success',286.00,'2021-05-18 00:40:48','Payment Received','Served',3),
(153,'Cancelled Order',0.00,'2021-05-19 00:16:31',NULL,NULL,NULL),
(154,'Success',286.00,'2021-05-19 00:23:03','Payment Received','Ongoing',3),
(155,'Success',1457.00,'2021-05-19 00:23:15','Payment Received','Ongoing',3),
(156,'Ongoing',0.00,'2021-05-19 00:33:58',NULL,NULL,NULL),
(157,'Cancelled Order',0.00,'2021-05-22 01:29:35',NULL,NULL,NULL),
(158,'Success',744.00,'2021-05-22 10:50:58','Payment Received','Served',3),
(159,'Ongoing',0.00,'2021-05-22 13:15:33',NULL,NULL,NULL),
(160,'Order Success',286.00,'2021-05-26 14:40:14','Waiting for Payment',NULL,NULL),
(161,'Order Success',529.00,'2021-05-26 14:58:25','Waiting for Payment',NULL,NULL),
(162,'Cancelled Order',0.00,'2021-06-08 10:10:40',NULL,NULL,NULL),
(163,'Cancelled Order',0.00,'2021-08-31 02:10:49',NULL,NULL,NULL);

/*Table structure for table `user_accounts` */

DROP TABLE IF EXISTS `user_accounts`;

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_level` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `user_accounts` */

insert  into `user_accounts`(`id`,`name`,`username`,`password`,`user_level`,`contact`) values 
(1,'Juan Dela Cruz','admin','admin','Admin','09123456789'),
(2,'Cardo Dalisay','user','user','Kitchen','09123456789'),
(3,'Super Man','user1','user1','Cashier','09123456789');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
