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
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `idx` mediumint(9) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `name` varchar(255) DEFAULT NULL,
  `parent` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '9999',
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Configurações','-1',10,'cogs'),(2,NULL,NULL,'2022-06-13 15:03:04',2,NULL,NULL,'yes','Menus','1',11,NULL),(3,NULL,NULL,'2022-06-13 15:05:16',2,NULL,NULL,'yes','Rotas','1',12,NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Empresas','-1',20,'building-o'),(5,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Empresas','4',21,NULL),(6,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Sócios','4',22,NULL),(7,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pedidos','-1',40,'inbox'),(8,NULL,NULL,'2022-06-13 20:01:44',2,NULL,NULL,'no','Pré-Pedidos','7',41,NULL),(9,NULL,NULL,'2022-06-13 20:01:38',2,NULL,NULL,'yes','Pedidos','7',42,NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Emitir NFe','7',43,NULL),(11,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Clientes','-1',30,'address-book'),(12,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Clientes','11',31,NULL),(13,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Gerentes','11',32,NULL),(14,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Grupos','11',33,NULL),(15,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contratos','11',34,NULL),(16,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Produtos','1',13,NULL),(17,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Urls','1',14,''),(18,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Centro de Custo','1',17,NULL),(19,NULL,NULL,NULL,NULL,NULL,NULL,'yes','CFOPS','7',44,NULL),(20,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Prestação de Serviços','7',45,''),(21,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Administração','-1',60,'user-circle-o'),(22,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Usuários','21',61,''),(23,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Perfis','21',62,NULL),(24,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contas a Pagar','-1',50,'fa fa-money');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
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
