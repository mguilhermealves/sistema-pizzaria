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
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `urls` (
  `idx` mediumint(9) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'yes',
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `pattern` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urls`
--

LOCK TABLES `urls` WRITE;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
INSERT INTO `urls` VALUES (1,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','URL Cadastrar','newurl','cadastrar_url'),(2,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Urls Listar','urls','urls'),(3,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Url Ação','url','url/%d'),(4,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Menu Cadastrar','newmenu','cadastrar_menu'),(5,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Menu Listar','menus','menus'),(6,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Menu Ação','menu','menu/%d'),(7,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Rota Ação','route','rota/%d'),(8,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Rotas Listar','routes','rotas'),(9,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Rota Cadastrar','new_route','cadastrar_rota'),(10,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Usuários Listar','users','usuarios'),(11,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Usuários Cadastrar','newuser','cadastrar_usuario'),(12,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Usuários Ação','user','usuario/%d'),(13,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Perfis Listar','profiles','perfis'),(14,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Perfis Ação','profile','perfil/%d'),(15,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Perfis Cadastrar','newprofile','cadastrar_perfil'),(16,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Empresas Ação','company','empresa/%d'),(17,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Empresas Cadastrar','newcompany','cadastrar_empresa'),(18,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Empresas Listar','companies','empresas'),(19,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Sócios Ação','partner','socio/%d'),(20,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Sócios Cadastrar','newpartner','cadastrar_socio'),(21,'2022-06-01 00:00:00',1,NULL,NULL,NULL,NULL,'yes','Sócios Listar','partners','socios'),(22,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pedidos Ação','order','pedido/%d'),(23,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pedidos Cadastrar','neworder','cadastrar_pedido'),(24,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pedidos Listar','orders','pedidos'),(25,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pré Pedidos Ação','preorder','pre-pedido/%d'),(26,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pré Pedidos Cadastrar','newpreorder','cadastrar_prepedido'),(27,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Pré Pedidos Listar','preorders','pre-pedidos'),(28,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Emitir NFe Ação','sendnfe','nfe/%d'),(29,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Emitir NFe Cadastrar','newsendnfe','cadastrar_nfe'),(30,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Emitir NFe Listar','sendnfes','nfes'),(31,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Clientes Ação','client','cliente/%d'),(32,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Clientes Cadastrar','newclient','cadastrar_cliente'),(33,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Clientes Listar','clients','clientes'),(34,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Gerentes Ação','manager','gerente/%d'),(35,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Gerentes Cadastrar','newmanager','cadastrar_gerente'),(36,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Gerentes Listar','managers','gerentes'),(37,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Grupos Ação','group','grupo/%d'),(38,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Grupos Cadastrar','newgroup','cadastrar_grupo'),(39,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Grupos Listar','groups','grupos'),(40,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contratos Ação','contract','contrato/%d'),(41,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contratos Cadastrar','newcontract','cadastrar_contrato'),(42,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contratos Listar','contracts','contratos'),(43,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Produtos Ação','product','produto/%d'),(44,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Produtos Cadastrar','newproduct','cadastrar_produto'),(45,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Produtos Listar','products','produtos'),(46,NULL,NULL,'2022-06-22 19:00:23',16,NULL,NULL,'yes','Centro de Custo Ação','cost_center','centro_de_custo/%d'),(47,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Centro de Custo Cadastrar','newcost_center','cadastrar_centro_de_custo'),(48,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Centro de Custo Listar','cost_centers','centro_de_custos'),(49,'2022-06-23 13:09:47',16,NULL,NULL,NULL,NULL,'yes','Esqueci minha senha','forgot_password','esqueci_minha_senha'),(50,'2022-06-24 14:39:26',16,'2022-06-24 20:31:08',16,NULL,NULL,'yes','Cfop Ação','cfop','cfop/%d'),(51,'2022-06-24 14:40:34',16,'2022-06-24 15:25:26',16,NULL,NULL,'yes','Cfop Cadastrar','newcfop','cadastrar_cfop'),(52,'2022-06-24 14:41:08',16,'2022-06-24 15:25:30',16,NULL,NULL,'yes','Cfops Listar','cfops','cfops'),(53,'2022-06-27 13:14:25',16,NULL,NULL,NULL,NULL,'yes','Prestação de Serviços Ação ','service_provision','prestacao_de_servicos/%d'),(54,'2022-06-27 13:15:34',16,NULL,NULL,NULL,NULL,'yes','Prestação de Serviços Cadastrar','newservice_provision','cadastrar_prestacao_de_servico'),(55,'2022-06-27 13:16:29',16,'2022-06-27 14:42:17',16,NULL,NULL,'yes','Prestação de Serviços Listar','services_provision','prestacao_de_servicos'),(56,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Tipo de Pedido Ação','typeservice','tipo-de-servico/%d'),(57,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Tipo de Pedido Cadastrar','newtypeservice','cadastrar_tipo_de_pedido'),(58,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Tipo de Pedido Listar','typeservices','tipo-de-servicos'),(59,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contas a Pagar Ação','accountpay','contas-a-pagar/%d'),(60,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contas a Pagar Cadastrar','newaccountpay','cadastrar_contas_a_pagar'),(61,NULL,NULL,NULL,NULL,NULL,NULL,'yes','Contas a Pagar Listar','accountpays','contas-a-pagar');
/*!40000 ALTER TABLE `urls` ENABLE KEYS */;
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
