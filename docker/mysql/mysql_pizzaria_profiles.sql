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
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `idx` mediumint(9) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `name` varchar(255) DEFAULT NULL,
  `editabled` enum('yes','no') DEFAULT 'yes',
  `slug` varchar(255) NOT NULL,
  `adm` enum('yes','no') DEFAULT 'no',
  `parent` int(11) DEFAULT '0',
  `description` longtext,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Master','no','master','yes',0,NULL),(2,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Administrador','no','administrador','yes',0,NULL),(3,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Presidente','no','presidente','yes',0,NULL),(4,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Sócios','no','socios','yes',0,NULL),(5,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Diretor(a)','no','diretor','yes',0,NULL),(6,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Gerente Comercial','yes','gerente','yes',0,NULL),(7,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Assistente','yes','assistente','yes',0,NULL),(8,'2022-05-20 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Auxiliar','yes','auxiliar','yes',0,NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Estagiario','yes','estagiario','yes',0,NULL);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-01  9:12:32
