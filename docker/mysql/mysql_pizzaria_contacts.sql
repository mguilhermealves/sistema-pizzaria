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
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `office` varchar(250) DEFAULT NULL,
  `postalcode` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `number` varchar(250) DEFAULT NULL,
  `complement` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `uf` varchar(250) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ramal` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `ramal2` varchar(255) DEFAULT NULL,
  `celphone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'2022-06-28 19:51:40',2,'2022-06-30 16:48:40',2,NULL,NULL,'yes','Marcos Guilherme','Alves da Silva','marcosguilhermealves@gmail.com','Gestor de TI','06766100','Rua Lauro da Silva','34','34','Parque Marabá','Taboão da Serra','SP','11478778885',NULL,NULL,NULL,'11970216020'),(2,'2022-06-28 20:23:29',2,'2022-06-30 14:44:26',2,NULL,NULL,'yes','Teste','da Silva','teste@teste.com.br','RH','06768100','Rua Teste','124','Casa 55','Teste Bairro','Teste Cidade','AC',NULL,NULL,NULL,NULL,NULL),(3,'2022-06-28 20:27:07',2,NULL,NULL,NULL,NULL,'yes','Marcos Guilherme Alves','Silva',NULL,'RH','06766150','Rua Carlos Cunha Filho','145',NULL,'cccc','Taboão da Serra','DF',NULL,NULL,NULL,NULL,NULL),(4,'2022-06-28 20:28:59',2,NULL,NULL,'2022-06-30 14:16:56',2,'no','Marcos Guilherme Alves','Silva',NULL,'RH','06766150','Rua Carlos Cunha Filho','145',NULL,'Parque Pinheiros','Taboão da Serra','DF',NULL,NULL,NULL,NULL,NULL),(5,'2022-06-28 20:29:39',2,NULL,NULL,'2022-06-30 14:12:16',2,'no','Marcos Guilherme Alves','Silva',NULL,'RH','06766150','Rua Carlos Cunha Filho','145',NULL,'Parque Pinheiros','Taboão da Serra','DF',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
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
