-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mysql_pizzaria
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `processed_by` int(11) DEFAULT NULL,
  `emission_at` datetime DEFAULT NULL,
  `emission_by` datetime DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `value` decimal(14,2) DEFAULT NULL,
  `tax` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `has_issued` enum('yes','no') NOT NULL DEFAULT 'no',
  `issued_at` datetime DEFAULT NULL,
  `issued_by` int(11) DEFAULT NULL,
  `has_processed` enum('yes','no') NOT NULL DEFAULT 'no',
  `expirated_at` datetime DEFAULT NULL,
  `has_balance_request` varchar(255) DEFAULT NULL,
  `companie_id` int(11) DEFAULT NULL,
  `timeline` longtext,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2022-06-28 13:57:26',2,NULL,NULL,NULL,NULL,NULL,NULL,'2022-06-28 00:00:00',NULL,'no',50000.00,'100','1','no',NULL,NULL,'no','2022-06-30 00:00:00','yes',1,'a:1:{i:0;a:7:{s:5:\"title\";s:18:\"Pré Pedido Criado\";s:11:\"description\";s:19:\"Pré pedido criado.\";s:4:\"date\";s:10:\"2022-06-28\";s:4:\"time\";s:8:\"10:57:26\";s:4:\"icon\";s:22:\"fa fa-envelope bg-blue\";s:5:\"color\";s:8:\"bg-green\";s:8:\"username\";s:16:\"Marcos Guilherme\";}}'),(2,'2022-06-28 13:58:54',2,NULL,NULL,NULL,NULL,NULL,NULL,'2022-06-28 00:00:00',NULL,'yes',50000.00,'100','1','no',NULL,NULL,'no','2022-06-30 00:00:00','yes',1,'a:1:{i:0;a:7:{s:5:\"title\";s:18:\"Pré Pedido Criado\";s:11:\"description\";s:19:\"Pré pedido criado.\";s:4:\"date\";s:10:\"2022-06-28\";s:4:\"time\";s:8:\"10:58:54\";s:4:\"icon\";s:22:\"fa fa-envelope bg-blue\";s:5:\"color\";s:8:\"bg-green\";s:8:\"username\";s:16:\"Marcos Guilherme\";}}');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-01  9:12:29
