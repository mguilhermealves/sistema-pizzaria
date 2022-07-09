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
-- Table structure for table `contacts_clients`
--

DROP TABLE IF EXISTS `contacts_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts_clients` (
  `idx` mediumint(9) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `contacts_id` int(11) DEFAULT NULL,
  `clients_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_clients`
--

LOCK TABLES `contacts_clients` WRITE;
/*!40000 ALTER TABLE `contacts_clients` DISABLE KEYS */;
INSERT INTO `contacts_clients` VALUES (1,NULL,NULL,NULL,NULL,'2022-06-30 14:55:50',2,'no',1,1),(2,NULL,NULL,NULL,NULL,'2022-06-30 14:25:13',2,'no',2,1),(3,'2022-06-28 20:28:59',2,NULL,NULL,NULL,NULL,'yes',4,1),(4,'2022-06-28 20:29:39',2,NULL,NULL,NULL,NULL,'yes',5,1),(5,'2022-06-30 14:25:13',2,NULL,NULL,'2022-06-30 14:26:06',2,'no',2,1),(6,'2022-06-30 14:26:06',2,NULL,NULL,'2022-06-30 14:27:39',2,'no',2,1),(7,'2022-06-30 14:27:39',2,NULL,NULL,'2022-06-30 14:44:26',2,'no',2,1),(8,'2022-06-30 14:44:26',2,NULL,NULL,NULL,NULL,'yes',2,1),(9,'2022-06-30 14:55:50',2,NULL,NULL,'2022-06-30 16:48:40',2,'no',1,1),(10,'2022-06-30 16:48:40',2,NULL,NULL,NULL,NULL,'yes',1,1);
/*!40000 ALTER TABLE `contacts_clients` ENABLE KEYS */;
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
