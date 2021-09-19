-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: rimba
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `name_customer` varchar(128) NOT NULL,
  `contact` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `type_diskon` varchar(128) NOT NULL,
  `img_ktp` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_customer`),
  UNIQUE KEY `id_customer_unique` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'achmad firdaus','123','achmadfirdaus244@gmail.com','bekasi',80,'presentase',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `name_item` varchar(128) NOT NULL,
  `unit` varchar(128) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  UNIQUE KEY `id_item_unique` (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Barang1','KG',87,20000,'');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `date` varchar(128) NOT NULL,
  `customer` varchar(128) NOT NULL,
  `toatal_diskon` decimal(10,0) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_transaction`),
  UNIQUE KEY `id_transaction_unique` (`id_transaction`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (3,'123','2021-09-13','achmad firdaus',80,816000,816000),(4,'123','2021-09-13','achmad firdaus',80,816000,816000),(5,'C001','2021-09-21','achmad firdaus',80,320000,160000),(6,'x001','2021-09-22','achmad firdaus',80,144000,244000),(7,'C0922','2021-09-20','achmad',10,10000,800000),(8,'10','','achmad firdaus',80,112000,90000),(9,'211','2021-09-14','achmad firdaus',80,32000,20000),(10,'123','2021-09-20','achmad firdaus',80,32000,20000),(11,'2123','2021-09-14','achmad firdaus',80,64000,12321),(12,'123','2021-09-14','achmad firdaus',80,32000,12312),(13,'1231','2021-09-21','achmad firdaus',80,64000,12312),(14,'312312312','2021-09-21','achmad',10,6000,123123),(15,'312312312','2021-09-21','achmad',10,10000,123123),(16,'123123123','2021-09-20','achmad firdaus',80,32000,123123);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_detail`
--

DROP TABLE IF EXISTS `sales_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_detail` (
  `id_transaction_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaction` int(11) NOT NULL,
  `qty` int(128) NOT NULL,
  `id_item` int(128) NOT NULL,
  PRIMARY KEY (`id_transaction_detail`),
  UNIQUE KEY `id_transaction_detail_unique` (`id_transaction_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_detail`
--

LOCK TABLES `sales_detail` WRITE;
/*!40000 ALTER TABLE `sales_detail` DISABLE KEYS */;
INSERT INTO `sales_detail` VALUES (1,3,1,1),(2,3,1,1),(3,5,10,1),(4,6,1,1),(5,6,2,1),(6,6,1,1),(7,6,1,1),(8,6,1,1),(9,6,2,1),(10,6,1,1),(11,6,0,1),(12,6,1,1),(13,6,1,1);
/*!40000 ALTER TABLE `sales_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_stagging`
--

DROP TABLE IF EXISTS `sales_stagging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_stagging` (
  `id_sales_stagging` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `qty` int(128) DEFAULT NULL,
  `total_harga` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_sales_stagging`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_stagging`
--

LOCK TABLES `sales_stagging` WRITE;
/*!40000 ALTER TABLE `sales_stagging` DISABLE KEYS */;
INSERT INTO `sales_stagging` VALUES (72,1,NULL,NULL,NULL),(73,1,1,1,20000),(74,1,2,2,16000);
/*!40000 ALTER TABLE `sales_stagging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rimba'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-19  7:53:02
