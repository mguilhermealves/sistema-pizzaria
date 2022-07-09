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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) NOT NULL DEFAULT '-',
  `mail` varchar(255) DEFAULT NULL,
  `marital_status` enum('singer','married','divorced','widower') DEFAULT 'singer',
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `cnh` varchar(45) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `genre` enum('wait','male','female') NOT NULL DEFAULT 'wait',
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  `phone` varchar(255) DEFAULT NULL,
  `celphone` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `address` text,
  `number` varchar(45) DEFAULT NULL,
  `complement` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `uf` varchar(45) DEFAULT NULL,
  `accept_at` datetime DEFAULT NULL,
  `token_auth_factors` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'0000-00-00 00:00:00',0,'2022-05-21 20:28:39',2,NULL,NULL,'yes','Raphael','Carpi','28126547839','rcarpi@hsolmkt.com.br','singer','rcarpi','e10adc3949ba59abbe56e057f20f883e','2331455','23666','2022-04-23 01:06:21','female','yes','1197016020','11970255555',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-15 12:43:33',NULL),(2,'2021-05-19 13:37:46',1,'2022-06-30 14:36:31',2,NULL,NULL,'yes','Marcos Guilherme','Alves da Silva','38044791891','malves@hsolmkt.com.br','singer','malves','e10adc3949ba59abbe56e057f20f883e','2331455','23666','2022-06-30 11:36:31','female','yes','1197016020','11970255555',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-14 17:49:33','9701'),(4,'0000-00-00 00:00:00',0,'2022-03-02 13:15:52',4,NULL,NULL,'yes','Zé','Máximo','35964965865','jsilva@hsolmkt.com.br','singer','jsilva','38d11b1ab4fe2d4c4a704a22a822f841',NULL,NULL,'2022-03-02 13:16:00','male','yes','(11) 11111-1111',NULL,'09639-000','Avenida Doutor Rudge Ramos','695','casa','Rudge Ramos','São Bernardo do Campo','SP','2022-02-10 17:38:00',NULL),(5,'2022-06-21 09:25:31',2,'2022-06-28 12:33:51',16,NULL,NULL,'yes','Julio','Arruda','41535908866','jarruda@hsolmkt.com.br','singer','jarruda','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'2022-06-28 09:33:51','male','yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1920');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-01  9:12:30
