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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `fees` varchar(250) DEFAULT NULL,
  `fine` varchar(250) DEFAULT NULL,
  `amount` decimal(14,2) DEFAULT NULL,
  `day_due` varchar(250) DEFAULT NULL,
  `payment_method` varchar(250) DEFAULT NULL,
  `historic_bank` longtext,
  `barcode` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `pdf` varchar(250) DEFAULT NULL,
  `expire_at` varchar(250) DEFAULT NULL,
  `charge_id` varchar(250) DEFAULT NULL,
  `total_atuality` varchar(250) DEFAULT NULL,
  `payment` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'2022-04-29 03:07:50',0,'2022-06-02 01:59:10',0,NULL,NULL,'yes',NULL,'unpaid',NULL,NULL,1500.00,'15','ticket','a:6:{i:0;a:2:{s:7:\"message\";s:16:\"Cobrança criada\";s:10:\"created_at\";s:19:\"2022-04-29 00:07:14\";}i:1;a:2:{s:7:\"message\";s:45:\"Pagamento via boleto aguardando confirmação\";s:10:\"created_at\";s:19:\"2022-04-29 00:07:50\";}i:2;a:2:{s:7:\"message\";s:53:\"Cobrança enviada para marcosguilhermealves@gmail.com\";s:10:\"created_at\";s:19:\"2022-04-29 00:07:50\";}i:3;a:2:{s:7:\"message\";s:40:\"Cliente visualizou esse boleto bancário\";s:10:\"created_at\";s:19:\"2022-04-29 00:24:16\";}i:4;a:2:{s:7:\"message\";s:55:\"Cobrança reenviada para marcosguilhermealves@gmail.com\";s:10:\"created_at\";s:19:\"2022-04-29 00:26:03\";}i:5;a:2:{s:7:\"message\";s:25:\"Pagamento não confirmado\";s:10:\"created_at\";s:19:\"2022-05-16 07:03:08\";}}','00000.00000 00000.000000 00000.000000 0 00000000000000','https://visualizacaosandbox.gerencianet.com.br/emissao/325275_163_DODRO2/A4XB-325275-163-DOCA2','https://download.gerencianet.com.br/325275_163_DODRO2/325275-163-DOCA2.pdf?sandbox=true','2022-05-15','1526219','150000','banking_billet'),(2,'2022-04-29 03:08:27',0,'2022-06-02 01:59:11',0,NULL,NULL,'yes',NULL,'unpaid',NULL,NULL,2000.00,'25','ticket','a:3:{i:0;a:2:{s:7:\"message\";s:16:\"Cobrança criada\";s:10:\"created_at\";s:19:\"2022-04-29 00:07:51\";}i:1;a:2:{s:7:\"message\";s:45:\"Pagamento via boleto aguardando confirmação\";s:10:\"created_at\";s:19:\"2022-04-29 00:08:26\";}i:2;a:2:{s:7:\"message\";s:25:\"Pagamento não confirmado\";s:10:\"created_at\";s:19:\"2022-05-26 07:01:27\";}}','00000.00000 00000.000000 00000.000000 0 00000000000000','https://visualizacaosandbox.gerencianet.com.br/emissao/325275_164_PACA5/A4XB-325275-164-CHODRO8','https://download.gerencianet.com.br/325275_164_PACA5/325275-164-CHODRO8.pdf?sandbox=true','2022-05-25','1526220','200000','banking_billet'),(3,'2022-05-29 17:48:57',2,'2022-05-29 14:48:57',NULL,NULL,NULL,'yes',NULL,NULL,NULL,NULL,NULL,NULL,'debit',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'2022-05-29 17:50:15',2,'2022-05-29 14:50:15',NULL,NULL,NULL,'yes',NULL,NULL,NULL,NULL,NULL,NULL,'debit',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'2022-05-29 17:52:30',2,'2022-05-29 14:52:30',NULL,NULL,NULL,'yes',NULL,NULL,NULL,NULL,NULL,NULL,'debit',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2022-06-01 22:22:31',0,'2022-06-02 01:59:12',0,NULL,NULL,'yes',NULL,'canceled',NULL,NULL,850.00,'1','ticket','a:4:{i:0;a:2:{s:7:\"message\";s:16:\"Cobrança criada\";s:10:\"created_at\";s:19:\"2022-06-01 19:21:52\";}i:1;a:2:{s:7:\"message\";s:45:\"Pagamento via boleto aguardando confirmação\";s:10:\"created_at\";s:19:\"2022-06-01 19:22:28\";}i:2;a:2:{s:7:\"message\";s:41:\"Cobrança enviada para teste@teste.com.br\";s:10:\"created_at\";s:19:\"2022-06-01 19:22:28\";}i:3;a:2:{s:7:\"message\";s:19:\"Cobrança cancelada\";s:10:\"created_at\";s:19:\"2022-06-01 19:34:48\";}}','00000.00000 00000.000000 00000.000000 0 00000000000000','https://visualizacaosandbox.gerencianet.com.br/emissao/325275_168_SERENA7/A4XB-325275-168-PAMAL5','https://download.gerencianet.com.br/325275_168_SERENA7/325275-168-PAMAL5.pdf?sandbox=true','2022-07-01','1634211','85000','banking_billet');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
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
