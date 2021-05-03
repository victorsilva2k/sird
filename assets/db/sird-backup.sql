CREATE DATABASE  IF NOT EXISTS `sird-db` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sird-db`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sird-db
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `agente`
--

DROP TABLE IF EXISTS `agente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agente` (
  `id_agente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `foto_arquivo` varchar(200) NOT NULL,
  `data_nasc` date NOT NULL,
  `genero` varchar(45) NOT NULL,
  PRIMARY KEY (`id_agente`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agente`
--

LOCK TABLES `agente` WRITE;
/*!40000 ALTER TABLE `agente` DISABLE KEYS */;
INSERT INTO `agente` VALUES (1,'João','Bastos','usuario.png','1990-01-04','Masculino'),(7,'Victorino','Kioza','usuario.png','2021-03-24','Masculino'),(18,'Rasmus','Lerdorf','8110-2021-03-26.jpeg','1999-12-15','Masculino'),(19,'Lina','Januário','1501-2021-03-26.jpeg','1980-08-09','Feminino'),(20,'James','Bila','usuario.png','1989-04-14','Masculino'),(22,'Mateus','Ngola','usuario.png','2021-04-16','Masculino');
/*!40000 ALTER TABLE `agente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agente_comando_municipal`
--

DROP TABLE IF EXISTS `agente_comando_municipal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agente_comando_municipal` (
  `id_agente` int NOT NULL,
  `id_cm` tinyint NOT NULL,
  `cargo` tinyint NOT NULL,
  KEY `id_oficial_idx` (`id_agente`),
  KEY `id_cm_idx` (`id_cm`),
  CONSTRAINT `id_agente-acm` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_cm-acm` FOREIGN KEY (`id_cm`) REFERENCES `comando_municipal` (`id_comando_municipal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agente_comando_municipal`
--

LOCK TABLES `agente_comando_municipal` WRITE;
/*!40000 ALTER TABLE `agente_comando_municipal` DISABLE KEYS */;
INSERT INTO `agente_comando_municipal` VALUES (7,1,1);
/*!40000 ALTER TABLE `agente_comando_municipal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agente_conta`
--

DROP TABLE IF EXISTS `agente_conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agente_conta` (
  `id_agente` int NOT NULL,
  `nip` mediumint NOT NULL,
  `password` varchar(200) NOT NULL,
  `estado_conta` tinyint NOT NULL DEFAULT '1',
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `nip_UNIQUE` (`nip`),
  KEY `id_oficial_idx` (`id_agente`),
  CONSTRAINT `id_agente-oc` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agente_conta`
--

LOCK TABLES `agente_conta` WRITE;
/*!40000 ALTER TABLE `agente_conta` DISABLE KEYS */;
INSERT INTO `agente_conta` VALUES (7,1220323,'$2y$10$TNqVf2n1JKzVdw/Hsb2SeOs/R6zHfGKRpjblNN6wef/EcKddp239a',1,'2021-03-23 15:12:14'),(22,1291919,'$2y$10$.aWM87wH2dFjs70/F/RQz.EwVqp8S5DkUPTsElpDyXsqFFcIUNqWe',0,'2021-04-22 21:31:09'),(1,1921765,'$2y$10$28vZsggb8wdw5t/MfbEDy.u40nqVO4goppauCG2qW7eAkHyxrFv3S',1,'2021-03-18 16:06:26'),(18,1985444,'$2y$10$DD0QNOW6GCftGIl9t8P6le4DgwhH4mNhG3q/yUfY0v7PJy7.HC1ty',2,'2021-03-26 15:53:49'),(20,3878372,'$2y$10$VOki2uuO9nlN.QtGBHZgs.zT0ZZOR.DERXVIQO5fQ8Asra4z3s6vm',2,'2021-03-26 16:25:45'),(19,7173713,'$2y$10$rLnm4dxANithuwmMpnNzmOD3eyZWZdv.IRYwNfTZT00kDGWN1lAnO',2,'2021-03-26 15:59:55');
/*!40000 ALTER TABLE `agente_conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agente_posto`
--

DROP TABLE IF EXISTS `agente_posto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agente_posto` (
  `id_agente` int NOT NULL,
  `id_posto` mediumint NOT NULL,
  `cargo` tinyint NOT NULL DEFAULT '1',
  KEY `id_oficial_idx` (`id_agente`),
  KEY `id_posto_idx` (`id_posto`),
  CONSTRAINT `id_agente-op` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_posto-op` FOREIGN KEY (`id_posto`) REFERENCES `posto` (`id_posto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agente_posto`
--

LOCK TABLES `agente_posto` WRITE;
/*!40000 ALTER TABLE `agente_posto` DISABLE KEYS */;
INSERT INTO `agente_posto` VALUES (1,1,1);
/*!40000 ALTER TABLE `agente_posto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bairro`
--

DROP TABLE IF EXISTS `bairro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bairro` (
  `id_bairro` smallint NOT NULL AUTO_INCREMENT,
  `bairro` varchar(100) NOT NULL,
  `distrito` mediumint NOT NULL,
  PRIMARY KEY (`id_bairro`),
  KEY `distrito-d_idx` (`distrito`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bairro`
--

LOCK TABLES `bairro` WRITE;
/*!40000 ALTER TABLE `bairro` DISABLE KEYS */;
INSERT INTO `bairro` VALUES (1,'Mundo Verdi',1),(2,'Dangereux',3),(3,'Mbondo Chapé',3),(6,'Camama 3',2),(7,'Simione',2),(8,'Kifica',3);
/*!40000 ALTER TABLE `bairro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_documento`
--

DROP TABLE IF EXISTS `categoria_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_documento` (
  `id_categoria_documento` tinyint NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_documento`
--

LOCK TABLES `categoria_documento` WRITE;
/*!40000 ALTER TABLE `categoria_documento` DISABLE KEYS */;
INSERT INTO `categoria_documento` VALUES (1,'Bilhete de Identidade '),(3,'Número de Contribuinte '),(5,'Cartão Eleitoral'),(6,'Cartão de Saúde'),(7,'Carta de Condução');
/*!40000 ALTER TABLE `categoria_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comando_municipal`
--

DROP TABLE IF EXISTS `comando_municipal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comando_municipal` (
  `id_comando_municipal` tinyint NOT NULL AUTO_INCREMENT,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comando_municipal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comando_municipal`
--

LOCK TABLES `comando_municipal` WRITE;
/*!40000 ALTER TABLE `comando_municipal` DISABLE KEYS */;
INSERT INTO `comando_municipal` VALUES (1,'2021-03-18 15:11:32');
/*!40000 ALTER TABLE `comando_municipal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `comando_municipal_informacao`
--

DROP TABLE IF EXISTS `comando_municipal_informacao`;
/*!50001 DROP VIEW IF EXISTS `comando_municipal_informacao`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `comando_municipal_informacao` AS SELECT 
 1 AS `id_cm`,
 1 AS `data_criacao`,
 1 AS `provincia`,
 1 AS `municipio`,
 1 AS `distrito`,
 1 AS `bairro`,
 1 AS `rua`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `comando_municipal_localizacao`
--

DROP TABLE IF EXISTS `comando_municipal_localizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comando_municipal_localizacao` (
  `id_cm` tinyint NOT NULL,
  `provincia` varchar(65) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `distrito` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(40) DEFAULT NULL,
  KEY `id_cm_idx` (`id_cm`),
  CONSTRAINT `id_cm-cml` FOREIGN KEY (`id_cm`) REFERENCES `comando_municipal` (`id_comando_municipal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comando_municipal_localizacao`
--

LOCK TABLES `comando_municipal_localizacao` WRITE;
/*!40000 ALTER TABLE `comando_municipal_localizacao` DISABLE KEYS */;
INSERT INTO `comando_municipal_localizacao` VALUES (1,'Luanda','Talatona','1','2','8');
/*!40000 ALTER TABLE `comando_municipal_localizacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distrito`
--

DROP TABLE IF EXISTS `distrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distrito` (
  `id_distrito` mediumint NOT NULL AUTO_INCREMENT,
  `distrito` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_distrito`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distrito`
--

LOCK TABLES `distrito` WRITE;
/*!40000 ALTER TABLE `distrito` DISABLE KEYS */;
INSERT INTO `distrito` VALUES (1,'Cidade Universitária'),(2,'Camama'),(3,'Talatona'),(4,'Lar do Patriota'),(5,'Futungo de Belas'),(6,'Benfica');
/*!40000 ALTER TABLE `distrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documentos` (
  `id_documento` int NOT NULL AUTO_INCREMENT,
  `categoria_documento` tinyint NOT NULL,
  `data_emissao` date DEFAULT NULL,
  `identifacador` varchar(20) DEFAULT NULL,
  `id_proprietario` mediumint NOT NULL,
  `estado` tinyint NOT NULL,
  PRIMARY KEY (`id_documento`),
  KEY `id_proprietario_idx` (`id_proprietario`),
  KEY `categoria_documento-d_idx` (`categoria_documento`),
  CONSTRAINT `categoria_documento-d` FOREIGN KEY (`categoria_documento`) REFERENCES `categoria_documento` (`id_categoria_documento`),
  CONSTRAINT `id_proprietario-d` FOREIGN KEY (`id_proprietario`) REFERENCES `propietario_documento` (`id_proprietario`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,1,'2021-04-25','poohh5155',1,1),(2,1,'2021-04-15','hhhy887',99,1),(3,1,'2021-04-15','hhhy887',77,1),(4,1,'2021-04-14','020i32',100,1),(5,1,'2021-04-14','020i32',101,3),(6,3,'2021-04-25','poohh5155',2,1),(7,3,'2021-04-25','poohh5155',99,1),(8,1,'2021-04-23','41e12e212',103,1),(9,1,'2021-04-23','41e12e212',104,1),(10,1,'2021-04-23','41e12e212',105,1),(11,1,'2021-04-23','41e12e212',107,1),(12,1,'2021-04-16','929329ue2',108,1),(13,1,'2021-04-07','999u9u',109,1),(14,1,'2021-04-07','999u9u',110,1),(15,1,'2021-04-07','999u9u',111,1),(16,1,'2021-04-07','999u9u',112,1),(17,1,'2021-04-06','E9I90W',113,1),(18,1,'2021-04-06','E9I90W',114,3),(19,1,'2021-04-06','E9I90W',115,2),(20,1,'2021-04-21','9283982g2uh2',116,1),(21,1,'2021-04-21','9283982g2uh2',117,1),(22,1,'2021-04-21','9283982g2uh2',118,1),(23,1,'2021-04-21','9283982g2uh2',119,1),(24,1,'2021-04-21','9283982g2uh2',120,1),(25,1,'2021-04-21','9283982g2uh2',121,1),(26,1,'2021-04-21','9283982g2uh2',122,1),(27,1,'2021-04-21','0920181HHJG1U2',123,3),(28,1,'2021-04-15','89R3OR3',124,3),(29,3,'2021-04-18','t4444443',125,3),(30,1,'2021-04-09','t4444443',126,3),(31,3,'2021-04-09','hhy666',127,3),(32,3,'2021-05-01','JWKJKW83722',128,3),(33,3,'2020-01-01','HHH12827',126,3),(34,5,'2021-05-05','eeerw32',129,1),(35,3,'2021-05-12','4353453',129,1),(36,5,'2021-05-07','j2he28723',130,1),(37,3,'2021-05-13','t4444443',131,1),(38,3,'2021-05-20','y3h38y3',131,1);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entregador_documento`
--

DROP TABLE IF EXISTS `entregador_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entregador_documento` (
  `id_entregador` int NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(200) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_entregador`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregador_documento`
--

LOCK TABLES `entregador_documento` WRITE;
/*!40000 ALTER TABLE `entregador_documento` DISABLE KEYS */;
INSERT INTO `entregador_documento` VALUES (1,'mano','91145254'),(2,'jdgjdjqwg dgwgdgwg','00808'),(3,'jdgjdjqwg dgwgdgwg','00808'),(4,'ghwowo','9201839192'),(5,'ghwowo','9201839192'),(6,'yui ioio','92321231'),(7,'yui ioio','92321231'),(8,'yui ioio','92321231'),(9,'yui ioio','92321231'),(10,'yui ioio','92321231'),(11,'whwi','99289382'),(12,'hbghh','9898979'),(13,'hbghh','9898979'),(14,'hbghh','9898979'),(15,'hbghh','9898979'),(16,'hhehe','823278782'),(17,'hhehe','823278782'),(18,'hhehe','823278782'),(19,'huhu','29832'),(20,'huhu','29832'),(21,'huhu','29832'),(22,'huhu','29832'),(23,'huhu','29832'),(24,'huhu','29832'),(25,'huhu','29832'),(26,'Joseano Silva','92345162'),(27,'9owpw','02020'),(28,'Miguel Santos','92354127'),(29,'Hamkil','92345123'),(30,'uriuryeet','97655'),(31,'Jorge Dnp','92345812'),(32,'kagkdahk','87942743'),(33,'hilka','83810831'),(34,'Manu Silva','929328992');
/*!40000 ALTER TABLE `entregador_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entregador_proprietario`
--

DROP TABLE IF EXISTS `entregador_proprietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entregador_proprietario` (
  `id_entregador` int NOT NULL,
  `id_proprietario` mediumint unsigned DEFAULT NULL,
  KEY `id_proprietario-ep_idx` (`id_proprietario`),
  KEY `id_entregador-ep_idx` (`id_entregador`),
  CONSTRAINT `id_entregador-ep` FOREIGN KEY (`id_entregador`) REFERENCES `entregador_documento` (`id_entregador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregador_proprietario`
--

LOCK TABLES `entregador_proprietario` WRITE;
/*!40000 ALTER TABLE `entregador_proprietario` DISABLE KEYS */;
INSERT INTO `entregador_proprietario` VALUES (1,1),(2,99),(3,77),(4,100),(5,101),(6,103),(7,104),(8,105),(9,106),(10,107),(11,108),(12,109),(13,110),(14,111),(15,112),(16,113),(17,114),(18,115),(19,116),(20,117),(21,118),(22,119),(23,120),(24,121),(25,122),(26,123),(27,124),(28,125),(29,126),(30,127),(31,128),(32,129),(33,130),(34,131);
/*!40000 ALTER TABLE `entregador_proprietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `estatisticas_comando_municipal`
--

DROP TABLE IF EXISTS `estatisticas_comando_municipal`;
/*!50001 DROP VIEW IF EXISTS `estatisticas_comando_municipal`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `estatisticas_comando_municipal` AS SELECT 
 1 AS `total_documentos`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `foto_documento`
--

DROP TABLE IF EXISTS `foto_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foto_documento` (
  `id_foto` mediumint NOT NULL AUTO_INCREMENT,
  `id_documento` int NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `id_documento_idx` (`id_documento`),
  CONSTRAINT `id_documento-fd` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto_documento`
--

LOCK TABLES `foto_documento` WRITE;
/*!40000 ALTER TABLE `foto_documento` DISABLE KEYS */;
INSERT INTO `foto_documento` VALUES (1,1,'no-img.png'),(2,1,'no-img.png'),(3,2,'usuario.png'),(4,2,'usuario.png'),(5,3,'usuario.png'),(6,3,'usuario.png'),(7,4,'6505-2021-04-26.jpeg'),(8,4,'7958-2021-04-26.jpeg'),(9,5,'2653-2021-04-26.jpeg'),(10,5,'8150-2021-04-26.jpeg'),(11,14,'470-2021-04-27.jpeg'),(12,15,'6015-2021-04-27.jpeg'),(13,16,'7701-2021-04-27.jpeg'),(14,16,'1403-2021-04-27.jpeg'),(15,17,'9696-2021-04-27.jpeg'),(16,18,'6484-2021-04-27.jpeg'),(17,18,'1393-2021-04-27.jpeg'),(18,19,'3348-2021-04-27.jpeg'),(19,19,'7545-2021-04-27.jpeg'),(20,27,'6090-2021-04-30.jpeg'),(21,27,'1552-2021-04-30.jpeg'),(22,28,'5607-2021-04-30.jpeg'),(23,28,'5921-2021-04-30.jpeg'),(24,29,'8034-2021-04-30.jpeg'),(25,29,'4110-2021-04-30.jpeg'),(26,30,'6423-2021-04-30.jpeg'),(27,30,'967-2021-04-30.jpeg'),(28,31,'1874-2021-04-30.jpeg'),(29,31,'9182-2021-04-30.jpeg'),(30,32,'429-2021-05-01.jpeg'),(31,32,'7860-2021-05-01.jpeg'),(32,30,'no-img.png'),(33,30,'no-img.png'),(34,33,'7860-2021-05-01.jpeg'),(35,33,'7860-2021-05-01.jpeg'),(36,34,'8195-2021-05-03.jpeg'),(37,34,'2128-2021-05-03.jpeg'),(38,35,'9329-2021-05-03.jpeg'),(39,35,'8928-2021-05-03.jpeg'),(40,36,'3140-2021-05-03.jpeg'),(41,36,'6332-2021-05-03.jpeg'),(42,37,'1683-2021-05-03.jpeg'),(43,37,'3387-2021-05-03.jpeg'),(44,38,'1267-2021-05-03.jpeg'),(45,38,'5977-2021-05-03.jpeg');
/*!40000 ALTER TABLE `foto_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `listar_documentos`
--

DROP TABLE IF EXISTS `listar_documentos`;
/*!50001 DROP VIEW IF EXISTS `listar_documentos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_documentos` AS SELECT 
 1 AS `nome_completo`,
 1 AS `id_proprietario`,
 1 AS `categorias`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `listar_postos`
--

DROP TABLE IF EXISTS `listar_postos`;
/*!50001 DROP VIEW IF EXISTS `listar_postos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_postos` AS SELECT 
 1 AS `id_posto`,
 1 AS `estado_actividade`,
 1 AS `tipo`,
 1 AS `nome`,
 1 AS `distrito`,
 1 AS `bairro`,
 1 AS `rua`,
 1 AS `municipio`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `local_documento`
--

DROP TABLE IF EXISTS `local_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `local_documento` (
  `tipo_local` enum('posto','comando') NOT NULL,
  `id_proprietario` mediumint NOT NULL,
  `id_local` int NOT NULL,
  KEY `id_proprietario-dl_idx` (`id_proprietario`),
  CONSTRAINT `id_proprietario-dl` FOREIGN KEY (`id_proprietario`) REFERENCES `propietario_documento` (`id_proprietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_documento`
--

LOCK TABLES `local_documento` WRITE;
/*!40000 ALTER TABLE `local_documento` DISABLE KEYS */;
INSERT INTO `local_documento` VALUES ('posto',1,1),('comando',77,1),('comando',100,1),('comando',101,1),('comando',112,1),('comando',114,1),('comando',115,1),('comando',123,1),('comando',124,1),('comando',125,1),('comando',126,1),('comando',127,1),('comando',128,1),('posto',129,1),('posto',129,1),('posto',130,1),('posto',131,1),('posto',131,1);
/*!40000 ALTER TABLE `local_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacao_comando_municipal`
--

DROP TABLE IF EXISTS `operacao_comando_municipal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operacao_comando_municipal` (
  `id_operacao` mediumint NOT NULL AUTO_INCREMENT,
  `id_agente` int NOT NULL,
  `id_cm` tinyint NOT NULL,
  `tipo` tinyint NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  KEY `id_oficial_idx` (`id_agente`),
  KEY `id_cm-ocm_idx` (`id_cm`),
  CONSTRAINT `id_agente-opcm` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_cm-opcm` FOREIGN KEY (`id_cm`) REFERENCES `comando_municipal` (`id_comando_municipal`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_comando_municipal`
--

LOCK TABLES `operacao_comando_municipal` WRITE;
/*!40000 ALTER TABLE `operacao_comando_municipal` DISABLE KEYS */;
INSERT INTO `operacao_comando_municipal` VALUES (2,1,1,2,'2021-03-20 15:11:00'),(3,1,1,2,'2021-03-23 14:56:44'),(4,7,1,2,'2021-04-07 11:09:17'),(5,7,1,2,'2021-04-19 21:57:51'),(6,7,1,2,'2021-04-19 22:16:00'),(7,7,1,2,'2021-04-19 22:17:35');
/*!40000 ALTER TABLE `operacao_comando_municipal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacao_documento`
--

DROP TABLE IF EXISTS `operacao_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operacao_documento` (
  `id_operacao` int NOT NULL AUTO_INCREMENT,
  `id_documento` int NOT NULL,
  `id_agente` int NOT NULL,
  `tipo` tinyint NOT NULL DEFAULT '1',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  KEY `id_documento_idx` (`id_documento`),
  KEY `id_oficial_idx` (`id_agente`),
  CONSTRAINT `id_agente-od` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_documento-od` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_documento`
--

LOCK TABLES `operacao_documento` WRITE;
/*!40000 ALTER TABLE `operacao_documento` DISABLE KEYS */;
INSERT INTO `operacao_documento` VALUES (2,1,1,1,'2021-04-25 22:48:27'),(3,3,7,1,'2021-04-26 14:30:17'),(4,4,7,1,'2021-04-26 15:40:02'),(5,5,7,1,'2021-04-26 15:40:39'),(6,19,7,1,'2021-04-27 11:28:15'),(7,27,7,1,'2021-04-30 11:45:36'),(12,18,1,4,'2021-04-30 13:01:35'),(15,27,7,4,'2021-04-30 13:12:31'),(16,28,7,1,'2021-04-30 13:50:37'),(17,29,7,1,'2021-04-30 14:03:55'),(18,29,7,4,'2021-04-30 14:12:23'),(19,30,7,1,'2021-04-30 14:36:21'),(20,31,7,1,'2021-04-30 15:11:20'),(21,31,7,4,'2021-04-30 15:13:16'),(22,32,7,1,'2021-05-01 12:30:29'),(23,32,7,4,'2021-05-01 12:32:04'),(24,33,7,1,'2021-05-01 12:32:04'),(25,32,7,2,'2021-05-03 19:44:05'),(26,30,1,4,'2021-05-03 19:47:32'),(27,33,1,4,'2021-05-03 19:47:32'),(28,28,1,4,'2021-05-03 19:48:17'),(29,19,1,4,'2021-05-03 20:09:45'),(30,18,1,4,'2021-05-03 20:10:35'),(31,5,1,4,'2021-05-03 20:14:25'),(32,34,1,1,'2021-05-03 20:48:36'),(33,35,1,1,'2021-05-03 20:48:36'),(34,36,1,1,'2021-05-03 20:50:05'),(35,37,1,1,'2021-05-03 20:51:51'),(36,38,1,1,'2021-05-03 20:51:51');
/*!40000 ALTER TABLE `operacao_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacao_posto`
--

DROP TABLE IF EXISTS `operacao_posto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operacao_posto` (
  `id_operacao` mediumint NOT NULL AUTO_INCREMENT,
  `id_agente` int NOT NULL,
  `id_posto` mediumint NOT NULL,
  `tipo` tinyint NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  KEY `id_oficial_idx` (`id_agente`),
  KEY `id_posto_idx` (`id_posto`),
  CONSTRAINT `id_agente-opt` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_posto-opt` FOREIGN KEY (`id_posto`) REFERENCES `posto` (`id_posto`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_posto`
--

LOCK TABLES `operacao_posto` WRITE;
/*!40000 ALTER TABLE `operacao_posto` DISABLE KEYS */;
INSERT INTO `operacao_posto` VALUES (1,1,1,1,'2021-03-18 15:59:34'),(2,7,4,1,'2021-03-25 21:41:09'),(4,7,1,2,'2021-03-26 15:05:13'),(5,7,1,2,'2021-03-26 15:05:20'),(6,7,1,2,'2021-03-26 15:05:25'),(7,7,1,2,'2021-03-26 15:05:30'),(8,7,1,2,'2021-03-26 15:05:37'),(9,7,1,2,'2021-03-26 15:05:55'),(10,7,1,2,'2021-03-26 15:06:10'),(11,7,1,2,'2021-03-26 15:06:17'),(14,7,8,1,'2021-04-07 11:12:53'),(15,7,9,1,'2021-04-11 20:27:38'),(16,7,9,3,'2021-04-11 20:27:46'),(17,7,11,1,'2021-04-19 22:35:18'),(18,7,1,2,'2021-04-19 22:43:14'),(19,7,12,1,'2021-04-25 23:09:28'),(20,7,1,2,'2021-04-29 13:51:51'),(21,7,1,2,'2021-04-29 13:56:56'),(22,7,4,2,'2021-04-29 13:58:23'),(23,7,8,2,'2021-04-29 13:58:32'),(24,7,9,2,'2021-04-29 13:58:46'),(25,7,12,2,'2021-04-29 13:58:54');
/*!40000 ALTER TABLE `operacao_posto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao_edicao`
--

DROP TABLE IF EXISTS `permissao_edicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissao_edicao` (
  `id_permissao` int NOT NULL AUTO_INCREMENT,
  `id_agente` int NOT NULL,
  `campo_editado` varchar(60) NOT NULL,
  `novo_valor` varchar(200) NOT NULL,
  `estado` tinyint DEFAULT '1',
  `agente_responsavel` int DEFAULT NULL,
  PRIMARY KEY (`id_permissao`),
  KEY `id_oficial_idx` (`id_agente`),
  CONSTRAINT `agente_responsavel` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_agente-pe` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao_edicao`
--

LOCK TABLES `permissao_edicao` WRITE;
/*!40000 ALTER TABLE `permissao_edicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissao_edicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posto`
--

DROP TABLE IF EXISTS `posto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posto` (
  `id_posto` mediumint NOT NULL AUTO_INCREMENT,
  `id_comando_municipal` tinyint NOT NULL,
  `tipo` tinyint DEFAULT NULL,
  `nome` varchar(55) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_actividade` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_posto`),
  KEY `id_comando_municipal_idx` (`id_comando_municipal`),
  CONSTRAINT `id_comando_municipal-p` FOREIGN KEY (`id_comando_municipal`) REFERENCES `comando_municipal` (`id_comando_municipal`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posto`
--

LOCK TABLES `posto` WRITE;
/*!40000 ALTER TABLE `posto` DISABLE KEYS */;
INSERT INTO `posto` VALUES (1,1,1,'Mbondo Chapé','2021-03-18 15:51:36',1),(4,1,1,'Mundo Verde','2021-03-25 21:41:09',1),(8,1,1,'7ª','2021-04-07 11:12:53',1),(9,1,1,'Fubu','2021-04-11 20:27:37',2),(11,1,1,'Qualquer','2021-04-19 22:35:18',1),(12,1,1,'Nova Vida 2','2021-04-25 23:09:28',1);
/*!40000 ALTER TABLE `posto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posto_localizacao`
--

DROP TABLE IF EXISTS `posto_localizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posto_localizacao` (
  `id_posto` mediumint NOT NULL,
  `distrito` varchar(45) NOT NULL,
  `bairro` smallint NOT NULL,
  `rua` varchar(40) DEFAULT NULL,
  KEY `id_posto_idx` (`id_posto`),
  KEY `bairro-pl_idx` (`bairro`),
  CONSTRAINT `bairro-pl` FOREIGN KEY (`bairro`) REFERENCES `bairro` (`id_bairro`),
  CONSTRAINT `id_posto-pl` FOREIGN KEY (`id_posto`) REFERENCES `posto` (`id_posto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posto_localizacao`
--

LOCK TABLES `posto_localizacao` WRITE;
/*!40000 ALTER TABLE `posto_localizacao` DISABLE KEYS */;
INSERT INTO `posto_localizacao` VALUES (1,'3',3,'7'),(4,'3',1,'6'),(8,'5',6,'4'),(9,'3',3,'8'),(11,'2',6,'9'),(12,'6',1,'1');
/*!40000 ALTER TABLE `posto_localizacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propietario_documento`
--

DROP TABLE IF EXISTS `propietario_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propietario_documento` (
  `id_proprietario` mediumint NOT NULL,
  `nome_completo` varchar(300) NOT NULL,
  PRIMARY KEY (`id_proprietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propietario_documento`
--

LOCK TABLES `propietario_documento` WRITE;
/*!40000 ALTER TABLE `propietario_documento` DISABLE KEYS */;
INSERT INTO `propietario_documento` VALUES (1,'victor'),(2,'Bilo da Silva'),(9,'Bilo da Silva'),(45,'Bilo da Silva'),(55,'Bilo da Silva'),(69,'Pat Iopa'),(77,'Pat Iopa'),(85,'Bilo da Silva'),(90,'Pat Iopa'),(99,'Pat Iopa'),(100,'Pat Iopa2'),(101,'Pat Iopa2'),(102,'heuw'),(103,'heuw'),(104,'heuw'),(105,'heuw'),(106,'heuw'),(107,'heuw'),(108,'Bilo'),(109,'0990i0i'),(110,'0990i0i'),(111,'0990i0i'),(112,'0990i0i'),(113,'hh2be2'),(114,'hh2be2'),(115,'hh2be2'),(116,'ppopo'),(117,'ppopo'),(118,'ppopo'),(119,'ppopo'),(120,'ppopo'),(121,'ppopo'),(122,'ppopo'),(123,'Bilo da Silva'),(124,'oaoqi'),(125,'Joao Paulo'),(126,'Bilo da Silva'),(127,'ptiro 94949'),(128,'Paulo Silva'),(129,'Pat Iopa1'),(130,'Kioza'),(131,'Manilson Cardo');
/*!40000 ALTER TABLE `propietario_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario_telefone`
--

DROP TABLE IF EXISTS `proprietario_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proprietario_telefone` (
  `id_proprietario` mediumint NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  KEY `id_proprietario_idx` (`id_proprietario`),
  CONSTRAINT `id_proprietario-pt` FOREIGN KEY (`id_proprietario`) REFERENCES `propietario_documento` (`id_proprietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario_telefone`
--

LOCK TABLES `proprietario_telefone` WRITE;
/*!40000 ALTER TABLE `proprietario_telefone` DISABLE KEYS */;
INSERT INTO `proprietario_telefone` VALUES (1,'923435643'),(99,'0909'),(77,'0909'),(100,'0283820'),(101,'0283820'),(1,'923435643'),(103,'92983982'),(104,'92983982'),(105,'92983982'),(106,'92983982'),(107,'92983982'),(108,'9239829'),(108,'98293829'),(109,'99900009'),(110,'99900009'),(111,'99900009'),(112,'99900009'),(113,'8293982'),(114,'8293982'),(115,'8293982'),(116,'921'),(116,'9234'),(117,'921'),(117,'9234'),(118,'921'),(118,'9234'),(119,'921'),(119,'9234'),(120,'921'),(120,'9234'),(121,'921'),(121,'9234'),(122,'921'),(122,'9234'),(123,'92345261'),(124,'22923'),(125,'923124534'),(126,'924352762'),(127,'92356543'),(128,'923462523'),(129,'98378743'),(129,'3423'),(130,'9283892'),(131,'92398929'),(131,'92346525');
/*!40000 ALTER TABLE `proprietario_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `ver_documento_agente`
--

DROP TABLE IF EXISTS `ver_documento_agente`;
/*!50001 DROP VIEW IF EXISTS `ver_documento_agente`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ver_documento_agente` AS SELECT 
 1 AS `nome_proprietario`,
 1 AS `id_proprietario`,
 1 AS `nome_entregador`,
 1 AS `telefone_entregador`,
 1 AS `categorias`,
 1 AS `datas`,
 1 AS `telefone_proprietario`,
 1 AS `ids`,
 1 AS `tipo_local`,
 1 AS `id_local`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `ver_documento_principal`
--

DROP TABLE IF EXISTS `ver_documento_principal`;
/*!50001 DROP VIEW IF EXISTS `ver_documento_principal`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ver_documento_principal` AS SELECT 
 1 AS `nome_completo`,
 1 AS `id_proprietario`,
 1 AS `categorias`,
 1 AS `datas`,
 1 AS `ids`,
 1 AS `tipo_local`,
 1 AS `id_local`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `ver_documentos_entregues`
--

DROP TABLE IF EXISTS `ver_documentos_entregues`;
/*!50001 DROP VIEW IF EXISTS `ver_documentos_entregues`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ver_documentos_entregues` AS SELECT 
 1 AS `nome_completo`,
 1 AS `id_proprietario`,
 1 AS `categorias`,
 1 AS `datas`,
 1 AS `ids`,
 1 AS `tipo_local`,
 1 AS `id_local`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `ver_posto`
--

DROP TABLE IF EXISTS `ver_posto`;
/*!50001 DROP VIEW IF EXISTS `ver_posto`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ver_posto` AS SELECT 
 1 AS `id_posto`,
 1 AS `tipo`,
 1 AS `data_criacao`,
 1 AS `nome`,
 1 AS `distrito`,
 1 AS `bairro`,
 1 AS `id_bairro`,
 1 AS `rua`,
 1 AS `municipio`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'sird-db'
--

--
-- Dumping routines for database 'sird-db'
--

--
-- Final view structure for view `comando_municipal_informacao`
--

/*!50001 DROP VIEW IF EXISTS `comando_municipal_informacao`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `comando_municipal_informacao` AS select `cm`.`id_comando_municipal` AS `id_cm`,`cm`.`data_criacao` AS `data_criacao`,`cml`.`provincia` AS `provincia`,`cml`.`municipio` AS `municipio`,`d`.`distrito` AS `distrito`,`b`.`bairro` AS `bairro`,`cml`.`rua` AS `rua` from (((`comando_municipal` `cm` join `comando_municipal_localizacao` `cml` on((`cm`.`id_comando_municipal` = `cml`.`id_cm`))) join `distrito` `d` on((`cml`.`distrito` = `d`.`id_distrito`))) join `bairro` `b` on((`cml`.`bairro` = `b`.`id_bairro`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `estatisticas_comando_municipal`
--

/*!50001 DROP VIEW IF EXISTS `estatisticas_comando_municipal`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `estatisticas_comando_municipal` AS select count(0) AS `total_documentos` from `documentos` union select count(0) AS `total_perdidos` from `documentos` where (`documentos`.`estado` = 1) union select count(0) AS `total_perdidos` from `documentos` where (`documentos`.`estado` = 3) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `listar_documentos`
--

/*!50001 DROP VIEW IF EXISTS `listar_documentos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listar_documentos` AS select `pd`.`nome_completo` AS `nome_completo`,`pd`.`id_proprietario` AS `id_proprietario`,group_concat(`cd`.`categoria` separator ',') AS `categorias` from ((`propietario_documento` `pd` join `documentos` `d` on((`pd`.`id_proprietario` = `d`.`id_proprietario`))) join `categoria_documento` `cd` on((`d`.`categoria_documento` = `cd`.`id_categoria_documento`))) group by `pd`.`id_proprietario` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `listar_postos`
--

/*!50001 DROP VIEW IF EXISTS `listar_postos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listar_postos` AS select `p`.`id_posto` AS `id_posto`,`p`.`estado_actividade` AS `estado_actividade`,`p`.`tipo` AS `tipo`,`p`.`nome` AS `nome`,`d`.`distrito` AS `distrito`,`b`.`bairro` AS `bairro`,`pl`.`rua` AS `rua`,`cml`.`municipio` AS `municipio` from ((((`posto` `p` join `posto_localizacao` `pl` on((`p`.`id_posto` = `pl`.`id_posto`))) join `bairro` `b` on((`b`.`id_bairro` = `pl`.`bairro`))) join `distrito` `d` on((`d`.`id_distrito` = `pl`.`distrito`))) join `comando_municipal_localizacao` `cml` on((`p`.`id_comando_municipal` = `cml`.`id_cm`))) where ((`p`.`estado_actividade` = 1) or (`p`.`estado_actividade` = 2)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ver_documento_agente`
--

/*!50001 DROP VIEW IF EXISTS `ver_documento_agente`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ver_documento_agente` AS select `pd`.`nome_completo` AS `nome_proprietario`,`pd`.`id_proprietario` AS `id_proprietario`,`ed`.`nome_completo` AS `nome_entregador`,`ed`.`telefone` AS `telefone_entregador`,group_concat(`cd`.`categoria` separator ',') AS `categorias`,group_concat(`od`.`data` separator ',') AS `datas`,group_concat(`pt`.`telefone` separator ',') AS `telefone_proprietario`,group_concat(`d`.`id_documento` separator ',') AS `ids`,`ld`.`tipo_local` AS `tipo_local`,`ld`.`id_local` AS `id_local` from ((((((((`propietario_documento` `pd` join `documentos` `d` on((`pd`.`id_proprietario` = `d`.`id_proprietario`))) join `operacao_documento` `od` on((`od`.`id_documento` = `d`.`id_documento`))) join `categoria_documento` `cd` on((`d`.`categoria_documento` = `cd`.`id_categoria_documento`))) join `foto_documento` `fd` on((`d`.`id_documento` = `fd`.`id_documento`))) join `local_documento` `ld` on((`ld`.`id_proprietario` = `pd`.`id_proprietario`))) join `proprietario_telefone` `pt` on((`pt`.`id_proprietario` = `pd`.`id_proprietario`))) join `entregador_proprietario` `ep` on((`ep`.`id_proprietario` = `pd`.`id_proprietario`))) join `entregador_documento` `ed` on((`ed`.`id_entregador` = `ep`.`id_entregador`))) where (`d`.`estado` = 1) group by `pd`.`id_proprietario` order by `pd`.`id_proprietario` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ver_documento_principal`
--

/*!50001 DROP VIEW IF EXISTS `ver_documento_principal`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ver_documento_principal` AS select `pd`.`nome_completo` AS `nome_completo`,`pd`.`id_proprietario` AS `id_proprietario`,group_concat(`cd`.`categoria` separator ',') AS `categorias`,group_concat(`od`.`data` separator ',') AS `datas`,group_concat(`d`.`id_documento` separator ',') AS `ids`,`ld`.`tipo_local` AS `tipo_local`,`ld`.`id_local` AS `id_local` from (((((`propietario_documento` `pd` join `documentos` `d` on((`pd`.`id_proprietario` = `d`.`id_proprietario`))) join `operacao_documento` `od` on((`od`.`id_documento` = `d`.`id_documento`))) join `categoria_documento` `cd` on((`d`.`categoria_documento` = `cd`.`id_categoria_documento`))) join `foto_documento` `fd` on((`d`.`id_documento` = `fd`.`id_documento`))) join `local_documento` `ld` on((`ld`.`id_proprietario` = `pd`.`id_proprietario`))) where (`d`.`estado` = 1) group by `pd`.`id_proprietario` order by `pd`.`id_proprietario` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ver_documentos_entregues`
--

/*!50001 DROP VIEW IF EXISTS `ver_documentos_entregues`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ver_documentos_entregues` AS select `pd`.`nome_completo` AS `nome_completo`,`pd`.`id_proprietario` AS `id_proprietario`,group_concat(`cd`.`categoria` separator ',') AS `categorias`,group_concat(`od`.`data` separator ',') AS `datas`,group_concat(`d`.`id_documento` separator ',') AS `ids`,`ld`.`tipo_local` AS `tipo_local`,`ld`.`id_local` AS `id_local` from (((((`propietario_documento` `pd` join `documentos` `d` on((`pd`.`id_proprietario` = `d`.`id_proprietario`))) join `operacao_documento` `od` on((`od`.`id_documento` = `d`.`id_documento`))) join `categoria_documento` `cd` on((`d`.`categoria_documento` = `cd`.`id_categoria_documento`))) join `foto_documento` `fd` on((`d`.`id_documento` = `fd`.`id_documento`))) join `local_documento` `ld` on((`ld`.`id_proprietario` = `pd`.`id_proprietario`))) where (`d`.`estado` = 3) group by `pd`.`id_proprietario` order by `pd`.`id_proprietario` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ver_posto`
--

/*!50001 DROP VIEW IF EXISTS `ver_posto`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ver_posto` AS select `p`.`id_posto` AS `id_posto`,`p`.`tipo` AS `tipo`,`p`.`data_criacao` AS `data_criacao`,`p`.`nome` AS `nome`,`pl`.`distrito` AS `distrito`,`b`.`bairro` AS `bairro`,`b`.`id_bairro` AS `id_bairro`,`pl`.`rua` AS `rua`,`cml`.`municipio` AS `municipio` from (((`posto` `p` join `posto_localizacao` `pl` on((`p`.`id_posto` = `pl`.`id_posto`))) join `bairro` `b` on((`b`.`id_bairro` = `pl`.`bairro`))) join `comando_municipal_localizacao` `cml` on((`p`.`id_comando_municipal` = `cml`.`id_cm`))) where ((`p`.`estado_actividade` = 1) or (`p`.`estado_actividade` = 2)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-03 21:25:53
