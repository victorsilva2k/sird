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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agente`
--

LOCK TABLES `agente` WRITE;
/*!40000 ALTER TABLE `agente` DISABLE KEYS */;
INSERT INTO `agente` VALUES (1,'João','Bastos','usuario.png','1990-01-04','Masculino'),(7,'Victorino','Kioza','usuario.png','2021-03-24','Masculino'),(18,'Rasmus','Lerdorf','8110-2021-03-26.jpeg','1999-12-15','Masculino'),(19,'Lina','Januário','1501-2021-03-26.jpeg','1980-08-09','Feminino'),(20,'James','Bila','usuario.png','1989-04-14','Masculino');
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
INSERT INTO `agente_conta` VALUES (7,1220323,'$2y$10$TNqVf2n1JKzVdw/Hsb2SeOs/R6zHfGKRpjblNN6wef/EcKddp239a',1,'2021-03-23 15:12:14'),(1,1921765,'$2y$10$28vZsggb8wdw5t/MfbEDy.u40nqVO4goppauCG2qW7eAkHyxrFv3S',1,'2021-03-18 16:06:26'),(18,1985444,'$2y$10$DD0QNOW6GCftGIl9t8P6le4DgwhH4mNhG3q/yUfY0v7PJy7.HC1ty',2,'2021-03-26 15:53:49'),(20,3878372,'$2y$10$VOki2uuO9nlN.QtGBHZgs.zT0ZZOR.DERXVIQO5fQ8Asra4z3s6vm',2,'2021-03-26 16:25:45'),(19,7173713,'$2y$10$rLnm4dxANithuwmMpnNzmOD3eyZWZdv.IRYwNfTZT00kDGWN1lAnO',2,'2021-03-26 15:59:55');
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
  `bairro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_bairro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bairro`
--

LOCK TABLES `bairro` WRITE;
/*!40000 ALTER TABLE `bairro` DISABLE KEYS */;
INSERT INTO `bairro` VALUES (1,'Mundo Verde'),(2,'Dangereux'),(3,'Mbondo Chapé');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_documento`
--

LOCK TABLES `categoria_documento` WRITE;
/*!40000 ALTER TABLE `categoria_documento` DISABLE KEYS */;
INSERT INTO `categoria_documento` VALUES (1,'Bilhete de Identidade '),(3,'Número de Contribuinte ');
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
INSERT INTO `comando_municipal_localizacao` VALUES (1,'Luanda','Talatona','SIAC','Belas','6');
/*!40000 ALTER TABLE `comando_municipal_localizacao` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregador_documento`
--

LOCK TABLES `entregador_documento` WRITE;
/*!40000 ALTER TABLE `entregador_documento` DISABLE KEYS */;
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
  `id_proprietario` mediumint NOT NULL,
  KEY `id_proprietario-ep_idx` (`id_proprietario`),
  KEY `id_entregador-ep_idx` (`id_entregador`),
  CONSTRAINT `id_entregador-ep` FOREIGN KEY (`id_entregador`) REFERENCES `entregador_documento` (`id_entregador`),
  CONSTRAINT `id_proprietario-ep` FOREIGN KEY (`id_proprietario`) REFERENCES `propietario_documento` (`id_proprietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregador_proprietario`
--

LOCK TABLES `entregador_proprietario` WRITE;
/*!40000 ALTER TABLE `entregador_proprietario` DISABLE KEYS */;
/*!40000 ALTER TABLE `entregador_proprietario` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto_documento`
--

LOCK TABLES `foto_documento` WRITE;
/*!40000 ALTER TABLE `foto_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `listar_postos`
--

DROP TABLE IF EXISTS `listar_postos`;
/*!50001 DROP VIEW IF EXISTS `listar_postos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `listar_postos` AS SELECT 
 1 AS `id_posto`,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_comando_municipal`
--

LOCK TABLES `operacao_comando_municipal` WRITE;
/*!40000 ALTER TABLE `operacao_comando_municipal` DISABLE KEYS */;
INSERT INTO `operacao_comando_municipal` VALUES (2,1,1,2,'2021-03-20 15:11:00'),(3,1,1,2,'2021-03-23 14:56:44');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_documento`
--

LOCK TABLES `operacao_documento` WRITE;
/*!40000 ALTER TABLE `operacao_documento` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacao_posto`
--

LOCK TABLES `operacao_posto` WRITE;
/*!40000 ALTER TABLE `operacao_posto` DISABLE KEYS */;
INSERT INTO `operacao_posto` VALUES (1,1,1,1,'2021-03-18 15:59:34'),(2,7,4,1,'2021-03-25 21:41:09'),(4,7,1,2,'2021-03-26 15:05:13'),(5,7,1,2,'2021-03-26 15:05:20'),(6,7,1,2,'2021-03-26 15:05:25'),(7,7,1,2,'2021-03-26 15:05:30'),(8,7,1,2,'2021-03-26 15:05:37'),(9,7,1,2,'2021-03-26 15:05:55'),(10,7,1,2,'2021-03-26 15:06:10'),(11,7,1,2,'2021-03-26 15:06:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posto`
--

LOCK TABLES `posto` WRITE;
/*!40000 ALTER TABLE `posto` DISABLE KEYS */;
INSERT INTO `posto` VALUES (1,1,1,'Mbondo Chapé','2021-03-18 15:51:36',1),(4,1,1,'Mundo Verde','2021-03-25 21:41:09',1);
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
INSERT INTO `posto_localizacao` VALUES (1,'Talatona',3,'7'),(4,'Talatona',1,'6');
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
  `telefone` mediumint NOT NULL,
  KEY `id_proprietario_idx` (`id_proprietario`),
  CONSTRAINT `id_proprietario-pt` FOREIGN KEY (`id_proprietario`) REFERENCES `propietario_documento` (`id_proprietario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario_telefone`
--

LOCK TABLES `proprietario_telefone` WRITE;
/*!40000 ALTER TABLE `proprietario_telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietario_telefone` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!50001 VIEW `comando_municipal_informacao` AS select `cm`.`id_comando_municipal` AS `id_cm`,`cm`.`data_criacao` AS `data_criacao`,`cml`.`provincia` AS `provincia`,`cml`.`municipio` AS `municipio`,`cml`.`distrito` AS `distrito`,`cml`.`bairro` AS `bairro`,`cml`.`rua` AS `rua` from (`comando_municipal` `cm` join `comando_municipal_localizacao` `cml` on((`cm`.`id_comando_municipal` = `cml`.`id_cm`))) */;
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
/*!50001 VIEW `listar_postos` AS select `p`.`id_posto` AS `id_posto`,`p`.`tipo` AS `tipo`,`p`.`nome` AS `nome`,`pl`.`distrito` AS `distrito`,`b`.`bairro` AS `bairro`,`pl`.`rua` AS `rua`,`cml`.`municipio` AS `municipio` from (((`posto` `p` join `posto_localizacao` `pl` on((`p`.`id_posto` = `pl`.`id_posto`))) join `bairro` `b` on((`b`.`id_bairro` = `pl`.`bairro`))) join `comando_municipal_localizacao` `cml` on((`p`.`id_comando_municipal` = `cml`.`id_cm`))) where (`p`.`estado_actividade` = 1) */;
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
/*!50001 VIEW `ver_posto` AS select `p`.`id_posto` AS `id_posto`,`p`.`tipo` AS `tipo`,`p`.`data_criacao` AS `data_criacao`,`p`.`nome` AS `nome`,`pl`.`distrito` AS `distrito`,`b`.`bairro` AS `bairro`,`b`.`id_bairro` AS `id_bairro`,`pl`.`rua` AS `rua`,`cml`.`municipio` AS `municipio` from (((`posto` `p` join `posto_localizacao` `pl` on((`p`.`id_posto` = `pl`.`id_posto`))) join `bairro` `b` on((`b`.`id_bairro` = `pl`.`bairro`))) join `comando_municipal_localizacao` `cml` on((`p`.`id_comando_municipal` = `cml`.`id_cm`))) where (`p`.`estado_actividade` = 1) */;
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

-- Dump completed on 2021-04-03  0:02:50
