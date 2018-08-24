CREATE DATABASE  IF NOT EXISTS `sistemaifrnsc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistemaifrnsc`;
-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: sistemaifrnsc
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AreaAtuacao`
--

DROP TABLE IF EXISTS `AreaAtuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AreaAtuacao` (
  `idAreaAtuacao` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`idAreaAtuacao`),
  UNIQUE KEY `area_UNIQUE` (`area`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AreaAtuacao`
--

LOCK TABLES `AreaAtuacao` WRITE;
/*!40000 ALTER TABLE `AreaAtuacao` DISABLE KEYS */;
INSERT INTO `AreaAtuacao` VALUES (1,'Administração'),(2,'Artes'),(3,'Biologia'),(4,'Comunicação'),(5,'Educação'),(6,'Educação Física'),(7,'Eletricidade/Eletrônica'),(8,'Filosofia'),(9,'Física'),(10,'Geografia'),(11,'História'),(12,'Letras'),(13,'Linguística'),(14,'Matemática'),(15,'Mecânica'),(16,'Química'),(17,'Redes de Computadores'),(18,'Refrigeração'),(19,'Serviço Social'),(20,'Sistemas de Informação'),(21,'Sociologia'),(22,'Suporte e Manutenção');
/*!40000 ALTER TABLE `AreaAtuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AvaliacaoTrabalho`
--

DROP TABLE IF EXISTS `AvaliacaoTrabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AvaliacaoTrabalho` (
  `idAvaliacaoTrabalho` int(11) NOT NULL AUTO_INCREMENT,
  `idTrabalho` int(11) NOT NULL,
  `ehFinal` int(11) NOT NULL DEFAULT '0',
  `numAvaliadores` int(11) NOT NULL DEFAULT '0',
  `avaliacoesFinalizadas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAvaliacaoTrabalho`),
  KEY `fkAvaliacaoTrabalho_Trabalho_idx` (`idTrabalho`),
  CONSTRAINT `fkAvaliacaoTrabalho_Trabalho` FOREIGN KEY (`idTrabalho`) REFERENCES `Trabalho` (`idTrabalho`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Quando o trabalho é submetido a uma avaliação, aqui são geradas as informações gerais da avaliação, bem como é utilizada na tabela [UsuarioAvaliação].';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AvaliacaoTrabalho`
--

LOCK TABLES `AvaliacaoTrabalho` WRITE;
/*!40000 ALTER TABLE `AvaliacaoTrabalho` DISABLE KEYS */;
/*!40000 ALTER TABLE `AvaliacaoTrabalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Certificado`
--

DROP TABLE IF EXISTS `Certificado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Certificado` (
  `idCertificado` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `texto` text NOT NULL COMMENT 'O texto deve ser escrito como o modelo: "Certificamos que #nome, titular do CPF: #cpf participou do evento #evento realizado no período de #inicio a #final na condição de #condicao.',
  `imagem` varchar(150) NOT NULL,
  PRIMARY KEY (`idCertificado`),
  KEY `fkCertificado_Evento_idx` (`idEvento`),
  CONSTRAINT `fkCertificado_Evento` FOREIGN KEY (`idEvento`) REFERENCES `Evento` (`idEvento`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contém as informações para geração dos certificados.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Certificado`
--

LOCK TABLES `Certificado` WRITE;
/*!40000 ALTER TABLE `Certificado` DISABLE KEYS */;
/*!40000 ALTER TABLE `Certificado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evento`
--

DROP TABLE IF EXISTS `Evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(450) NOT NULL,
  `descricao` text NOT NULL,
  `local` text NOT NULL,
  `numVagas` int(11) NOT NULL,
  `inicioInscricao` date NOT NULL,
  `finalInscricao` date NOT NULL,
  `inicioSubmissao` date DEFAULT NULL,
  `finalSubmissao` date DEFAULT NULL,
  `inicioEvento` date NOT NULL,
  `finalEvento` date NOT NULL,
  `idEventoPrincipal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvento`),
  KEY `fkEvento_Evento_idx` (`idEventoPrincipal`),
  CONSTRAINT `fkEvento_Evento` FOREIGN KEY (`idEventoPrincipal`) REFERENCES `Evento` (`idEvento`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Nesta tabela são relacionados os eventos do sistema. É importante ressaltar que uma mostra tecnológica em uma Expotec, por exemplo, a mostra tecnológica é um subevento do evento Expotec. permitindo assim que para cada grande evento, suas mostras ou momentos possam ser relacionados de forma dinâmica e individualizados, facilitando a avaliação de trabalhos, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evento`
--

LOCK TABLES `Evento` WRITE;
/*!40000 ALTER TABLE `Evento` DISABLE KEYS */;
INSERT INTO `Evento` VALUES (1,'VII EXPOTEC IFRN-SC','Resumo do evento do ano passado','R. São Braz, 304 - Paraiso, Santa Cruz - RN, 59200-000',0,'2018-06-22','2018-06-30',NULL,NULL,'2018-07-12','2018-07-14',NULL),(3,'Teste 001','Evento de teste 001','Local de teste 001',20,'2018-06-22','2018-06-29',NULL,NULL,'2018-07-02','2018-07-04',NULL),(4,'Minicurso C#','C# é uma linguagem de programação de alto nível desenvolvida pela Microsoft.','Laboratório 63',10,'2018-06-22','2018-06-30','2018-06-22','2018-07-05','2018-07-27','2018-07-28',1),(5,'Submeter','Submeter','Local 0',0,'2018-08-22','2018-08-24','2018-08-22','2018-08-23','2018-08-24','2018-08-26',NULL),(6,'Sub submeter','Sub submeter','01',12,'2018-08-22','2018-08-24','2018-08-22','2018-08-24','2018-08-24','2018-08-26',5),(7,'Com anexos','Esse deve gravar anexos','olha nos anexos',0,'2018-08-23','2018-08-23','2018-08-23','2018-08-23','2018-08-24','2018-08-24',NULL),(8,'Com anexos 02','Esse deve gravar anexos','olha nos anexos',0,'2018-08-23','2018-08-23','2018-08-23','2018-08-23','2018-08-24','2018-08-24',NULL),(9,'Com anexos 03','Tem anexos?','olha nos anexos',0,'2018-08-23','2018-08-24','2018-08-23','2018-08-24','2018-08-24','2018-08-24',NULL),(10,'Com anexos 03','Tem anexos?','olha nos anexos',0,'2018-08-23','2018-08-24','2018-08-23','2018-08-24','2018-08-24','2018-08-24',NULL),(11,'anexos?','onde?','num sei',0,'2018-08-23','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',8),(12,'anexos?','onde?','num sei',0,'2018-08-23','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',8),(13,'Anexos 04','qwe','qwe',1,'2018-08-23','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',NULL),(14,'Anexos 04','qwe','qwe',1,'2018-08-23','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',NULL),(15,'Anexos 05','Segue anexos','olhe nos anexos',0,'2018-08-23','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',NULL),(16,'Anexos 10','Seguem anexos diversos','Olhe nos anexos',0,'2018-08-24','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',NULL),(17,'Anexos 11','segue','anexos',0,'2018-08-24','2018-08-24',NULL,NULL,'2018-08-24','2018-08-24',NULL);
/*!40000 ALTER TABLE `Evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventoTipoAnexo`
--

DROP TABLE IF EXISTS `EventoTipoAnexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventoTipoAnexo` (
  `idEventoTipoAnexo` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `idTipoAnexo` int(11) NOT NULL,
  `arquivo` varchar(50) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idEventoTipoAnexo`),
  KEY `fkEvento_TipoAnexo_idx` (`idEvento`),
  KEY `fkEventoTipoAnexo_TipoAnexo_idx` (`idTipoAnexo`),
  CONSTRAINT `fkEventoTipoAnexo_Evento` FOREIGN KEY (`idEvento`) REFERENCES `Evento` (`idEvento`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fkEventoTipoAnexo_TipoAnexo` FOREIGN KEY (`idTipoAnexo`) REFERENCES `TipoAnexo` (`idTipoAnexo`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='Relaciona os documentos (termos de uso, imagens e modelos) associados a um evento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventoTipoAnexo`
--

LOCK TABLES `EventoTipoAnexo` WRITE;
/*!40000 ALTER TABLE `EventoTipoAnexo` DISABLE KEYS */;
INSERT INTO `EventoTipoAnexo` VALUES (3,1,1,'VII_EXPOTEC_IFRN-SC1.png',NULL),(4,1,2,'VII_EXPOTEC_IFRN-SC1.png','Termos de Uso'),(5,1,3,'VII_EXPOTEC_IFRN-SC1.png','Modelo de banner'),(6,1,3,'VII_EXPOTEC_IFRN-SC1.png','Modelo de resumo'),(7,8,1,'evento_2.jpg','Logomarca do evento: Com anexos 02'),(8,9,1,'evento_0.jpg','Logomarca do evento: Com anexos 03'),(9,9,2,'termos_0.pdf','Termos de Uso'),(10,10,1,'evento_1.jpg','Logomarca do evento: Com anexos 03'),(11,10,2,'termos_0.pdf','Termos de Uso'),(12,11,1,'evento_2.jpg','Logomarca do evento: anexos?'),(13,11,2,'termos_0.pdf','Termos de Uso'),(14,12,1,'evento_3.jpg','Logomarca do evento: anexos?'),(15,12,2,'termos_0.pdf','Termos de Uso'),(16,13,1,'evento_4.jpg','Logomarca do evento: Anexos 04'),(17,13,2,'termos_0.pdf','Termos de Uso'),(18,14,1,'evento_5.jpg','Logomarca do evento: Anexos 04'),(19,14,2,'termos_0.pdf','Termos de Uso'),(20,15,1,'evento_6.jpg','Logomarca do evento: Anexos 05'),(21,15,2,'termos_0.pdf','Termos de Uso'),(22,16,1,'evento_7.jpg','Logomarca do evento: Anexos 10'),(23,16,2,'termos_1.pdf','Termos de Uso'),(24,16,3,'modelo1_0.odt',''),(25,16,3,'modelo2_0.odt',''),(26,17,1,'evento_8.jpg','Logomarca do evento: Anexos 11'),(27,17,2,'termos_2.pdf','Termos de Uso'),(28,17,3,'modelo1_1.odt','Modelo 01'),(29,17,3,'modelo2_1.odt','Modelo 02');
/*!40000 ALTER TABLE `EventoTipoAnexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NivelAcesso`
--

DROP TABLE IF EXISTS `NivelAcesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NivelAcesso` (
  `idNivelAcesso` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(450) NOT NULL,
  PRIMARY KEY (`idNivelAcesso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Relaciona os níveis de acesso de usuário no sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NivelAcesso`
--

LOCK TABLES `NivelAcesso` WRITE;
/*!40000 ALTER TABLE `NivelAcesso` DISABLE KEYS */;
INSERT INTO `NivelAcesso` VALUES (1,'Participante'),(2,'Organizador'),(3,'teste001');
/*!40000 ALTER TABLE `NivelAcesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StatusInscricao`
--

DROP TABLE IF EXISTS `StatusInscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StatusInscricao` (
  `idStatusInscricao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(450) NOT NULL,
  PRIMARY KEY (`idStatusInscricao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Relaciona os possíveis status que uma inscrição pode sofrer em um dado evento.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StatusInscricao`
--

LOCK TABLES `StatusInscricao` WRITE;
/*!40000 ALTER TABLE `StatusInscricao` DISABLE KEYS */;
INSERT INTO `StatusInscricao` VALUES (1,'Confirmada'),(2,'Rejeitada'),(3,'Aguardando confirmação'),(4,'Credenciado');
/*!40000 ALTER TABLE `StatusInscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StatusTrabalho`
--

DROP TABLE IF EXISTS `StatusTrabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StatusTrabalho` (
  `idStatusTrabalho` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(450) NOT NULL,
  PRIMARY KEY (`idStatusTrabalho`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Relaciona os possíveis status que um trabalho pode sofrer em um dado (sub) evento.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StatusTrabalho`
--

LOCK TABLES `StatusTrabalho` WRITE;
/*!40000 ALTER TABLE `StatusTrabalho` DISABLE KEYS */;
INSERT INTO `StatusTrabalho` VALUES (1,'Gravado');
/*!40000 ALTER TABLE `StatusTrabalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoAnexo`
--

DROP TABLE IF EXISTS `TipoAnexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoAnexo` (
  `idTipoAnexo` int(11) NOT NULL AUTO_INCREMENT,
  `TipoAnexocol` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipoAnexo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Lista os tipos de documentos que podem ser anexados';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoAnexo`
--

LOCK TABLES `TipoAnexo` WRITE;
/*!40000 ALTER TABLE `TipoAnexo` DISABLE KEYS */;
INSERT INTO `TipoAnexo` VALUES (1,'Imagem'),(2,'Termos de uso'),(3,'Modelo');
/*!40000 ALTER TABLE `TipoAnexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Trabalho`
--

DROP TABLE IF EXISTS `Trabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trabalho` (
  `idTrabalho` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(450) NOT NULL,
  `resumo` text NOT NULL,
  `arquivo` varchar(500) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idStatusTrabalho` int(11) NOT NULL,
  `palavrasChave` varchar(100) NOT NULL,
  `instituicao` varchar(450) NOT NULL,
  PRIMARY KEY (`idTrabalho`),
  KEY `fkTrabalho_Evento_idx` (`idEvento`),
  KEY `fkTrabalho_StatusTrabalho_idx` (`idStatusTrabalho`),
  CONSTRAINT `fkTrabalho_Evento` FOREIGN KEY (`idEvento`) REFERENCES `Evento` (`idEvento`) ON UPDATE NO ACTION,
  CONSTRAINT `fkTrabalho_StatusTrabalho` FOREIGN KEY (`idStatusTrabalho`) REFERENCES `StatusTrabalho` (`idStatusTrabalho`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='Lista os trabalhos cadastrados para o dado (sub) evento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trabalho`
--

LOCK TABLES `Trabalho` WRITE;
/*!40000 ALTER TABLE `Trabalho` DISABLE KEYS */;
INSERT INTO `Trabalho` VALUES (1,'Insert direto no banco','Resumo...','coisa.pdf',4,1,'palavra, teste','Inst de teste'),(2,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo',''),(3,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo',''),(4,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo',''),(5,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo',''),(6,'Título 001','Resumo 001','4_2_Título 0010.pdf',4,1,'palavra, 001',''),(7,'Título 001','Resumo 001','4_2_0.pdf',4,1,'palavra, 001',''),(8,'Título 001','Resumo 001','4_2_1.pdf',4,1,'palavra, 001',''),(9,'Título 001','Resumo 001','4_3_0.pdf',4,1,'palavra, teste, 001','IFRN 001'),(10,'Trabalho de informática','Trabalho de informática cadastrado a partir do sistema de submissão do Campus','4_2_2.pdf',4,1,'Teste, Trabalho, informática',''),(11,'1234','12345','4_2_3.pdf',4,1,'1, 2, 3',''),(12,'1234','12345','4_2_4.pdf',4,1,'1, 2, 3',''),(13,'1234','12345','4_2_5.pdf',4,1,'1, 2, 3',''),(14,'1234','12345','4_2_6.pdf',4,1,'1, 2, 3',''),(15,'Educação Física','Educação Física','4_2_7.pdf',4,1,'Educação, Física',''),(16,'Educação Física','Educação Física','4_2_7.pdf',4,1,'Educação, Física',''),(17,'123','123','4_2_8.pdf',4,1,'123',''),(18,'GRU','Segue GRU paga','5_2_0.pdf',5,1,'GRU, Refrigeração',''),(19,'GRU','Segue GRU paga','5_2_1.pdf',5,1,'GRU, refrigeração',''),(20,'Comunicação de sistemas','Comunicação de sistemas em diferentes canais de redes','5_16_0.pdf',5,1,'Comunicação, Rede, Sistema','');
/*!40000 ALTER TABLE `Trabalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrabalhoArea`
--

DROP TABLE IF EXISTS `TrabalhoArea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrabalhoArea` (
  `idTrabalhoArea` int(11) NOT NULL AUTO_INCREMENT,
  `idTrabalho` int(11) NOT NULL,
  `idAreaAtuacao` int(11) NOT NULL,
  PRIMARY KEY (`idTrabalhoArea`),
  KEY `fkTrabalhoArea_Trabalho_idx` (`idTrabalho`),
  KEY `fkTrabalhoArea_AreaAtuacao_idx` (`idAreaAtuacao`),
  CONSTRAINT `fkTrabalhoArea_AreaAtuacao` FOREIGN KEY (`idAreaAtuacao`) REFERENCES `AreaAtuacao` (`idAreaAtuacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkTrabalhoArea_Trabalho` FOREIGN KEY (`idTrabalho`) REFERENCES `Trabalho` (`idTrabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrabalhoArea`
--

LOCK TABLES `TrabalhoArea` WRITE;
/*!40000 ALTER TABLE `TrabalhoArea` DISABLE KEYS */;
INSERT INTO `TrabalhoArea` VALUES (1,1,4),(2,1,5),(3,1,6),(4,1,7),(5,9,10),(6,9,12),(7,10,17),(8,10,20),(9,10,22),(10,11,15),(11,11,9),(12,12,15),(13,12,9),(14,13,15),(15,13,9),(16,14,15),(17,14,9),(18,15,6),(19,16,6),(20,17,1),(21,18,18),(22,18,10),(23,19,18),(24,20,20),(25,20,4),(26,20,17);
/*!40000 ALTER TABLE `TrabalhoArea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `matricula` varchar(15) DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  `avaliador` int(11) NOT NULL DEFAULT '0',
  `administrador` int(11) NOT NULL DEFAULT '0',
  `lattes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='Lista geral dos usuários (inscritos) cadastrados no sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'999.000.000-00','Senha123','Teste','teste9999_@teste.com','','',0,0,NULL),(2,'000.000.000-00','10a9c136d796bab18d3e144092a4f20a','Marcelo zero','marcelo00@teste.com','','00000000000.jpg',1,1,NULL),(3,'000.000.000-01','10a9c136d796bab18d3e144092a4f20a','Marcelo um','marcelo001@teste.com','','',0,0,NULL),(4,'000.000.000-02','10a9c136d796bab18d3e144092a4f20a','Marcelo Dois','marcelo002@teste.com','','00000000002.jpg',0,0,NULL),(5,'000.000.000-03','10a9c136d796bab18d3e144092a4f20a','Marcelo Três','marcelo003@teste.com','','00000000003.jpg',0,0,NULL),(6,'000.000.000-04','10a9c136d796bab18d3e144092a4f20a','Marcelo Quatro','marcelo004@teste.com','','',0,0,NULL),(7,'000.000.000-05','10a9c136d796bab18d3e144092a4f20a','Marcelo Cinco','marcelo005@teste.com','','',0,0,NULL),(8,'000.000.000-06','10a9c136d796bab18d3e144092a4f20a','Marcelo Seis','marcelo006@teste.com','','00000000006_0.png',0,0,NULL),(9,'000.000.000-07','10a9c136d796bab18d3e144092a4f20a','Marcelo Sete','marcelo007@teste.com','','00000000007_0.png',0,0,NULL),(10,'000.000.000-08','10a9c136d796bab18d3e144092a4f20a','Marcelo Oito','marcelo008@teste.com','','00000000008_0.png',0,0,NULL),(11,'000.000.000-09','10a9c136d796bab18d3e144092a4f20a','Marcelo Nove','marcelo009@teste.com','','00000000009_0.png',1,1,NULL),(12,'000.000.000-10','10a9c136d796bab18d3e144092a4f20a','Marcelo Dez','marcelo010@teste.com','','',0,0,NULL),(13,'000.000.000-11','10a9c136d796bab18d3e144092a4f20a','Marcelo Onze','marcelo011@teste.com','','',0,0,NULL),(14,'000.000.000-12','10a9c136d796bab18d3e144092a4f20a','Marcelo Doze','marcelo12@teste.com','','00000000012_0.jpg',2,0,NULL),(15,'000.000.000-13','10a9c136d796bab18d3e144092a4f20a','Marcelo Treze','marcelo013@teste.com','','00000000013_1.jpg',2,0,NULL),(16,'000.000.000-14','10a9c136d796bab18d3e144092a4f20a','Marcelo Catorze','marcelo014@teste.com','','00000000014_0.jpg',2,0,''),(17,'000.000.000-15','10a9c136d796bab18d3e144092a4f20a','Marcelo Quinze','marcelo015@teste.com','','00000000015_0.jpg',2,0,''),(18,'000.000.000-16','10a9c136d796bab18d3e144092a4f20a','Marcelo Desesseis','marcelo016@teste.com','','00000000016_0.jpg',2,0,'http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4904232U7'),(19,'000.000.000-17','10a9c136d796bab18d3e144092a4f20a','Marcelo Desessete','marcelo017@teste.com','','00000000017_0.jpg',0,0,''),(20,'000.000.000-18','10a9c136d796bab18d3e144092a4f20a','Marcelo Desoito','marcelo018@teste.com','','00000000018_0.jpg',0,0,'');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsuarioArea`
--

DROP TABLE IF EXISTS `UsuarioArea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsuarioArea` (
  `idUsuarioArea` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idAreaAtuacao` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarioArea`),
  KEY `fkUsuarioArea_Usuario_idx` (`idUsuario`),
  KEY `fkUsuarioArea_AreaAtuacao_idx` (`idAreaAtuacao`),
  CONSTRAINT `fkUsuarioArea_AreaAtuacao` FOREIGN KEY (`idAreaAtuacao`) REFERENCES `AreaAtuacao` (`idAreaAtuacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioArea_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioArea`
--

LOCK TABLES `UsuarioArea` WRITE;
/*!40000 ALTER TABLE `UsuarioArea` DISABLE KEYS */;
INSERT INTO `UsuarioArea` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,20),(5,2,14),(6,2,17),(7,3,20),(8,3,9),(9,4,2),(10,4,4),(11,5,12),(12,5,13),(13,6,4),(14,7,5),(15,8,7),(16,9,5),(17,10,5),(18,11,8),(19,11,13),(20,14,17),(21,14,20),(22,15,1),(23,15,4),(24,16,20),(25,17,20),(26,18,20);
/*!40000 ALTER TABLE `UsuarioArea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsuarioAvaliacao`
--

DROP TABLE IF EXISTS `UsuarioAvaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsuarioAvaliacao` (
  `idUsuarioAvaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idAvaliacao` int(11) NOT NULL,
  `nota` double NOT NULL DEFAULT '0',
  `comentario` text,
  `finalizado` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  PRIMARY KEY (`idUsuarioAvaliacao`),
  KEY `fkUsuarioAvaliacao_Usuario_idx` (`idUsuario`),
  KEY `fkUsuarioAvaliacao_Avaliacao_idx` (`idAvaliacao`),
  CONSTRAINT `fkUsuarioAvaliacao_Avaliacao` FOREIGN KEY (`idAvaliacao`) REFERENCES `AvaliacaoTrabalho` (`idAvaliacaoTrabalho`) ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioAvaliacao_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Faz uma relação entre a tabela [AvaliacaoTrabalho] e [Usuario], indicando que usuários estão responsáveis por avaliar um trabalho.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioAvaliacao`
--

LOCK TABLES `UsuarioAvaliacao` WRITE;
/*!40000 ALTER TABLE `UsuarioAvaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `UsuarioAvaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsuarioEvento`
--

DROP TABLE IF EXISTS `UsuarioEvento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsuarioEvento` (
  `idUsuarioEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idStatusInscricao` int(11) NOT NULL,
  `idNivelAcesso` int(11) NOT NULL,
  `presente` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuarioEvento`),
  KEY `fkUsuarioEvento_Usuario_idx` (`idUsuario`),
  KEY `fkUsuarioEvento_Evento_idx` (`idEvento`),
  KEY `fkUsuarioEvento_StatusInscricao_idx` (`idStatusInscricao`),
  KEY `fkUsuarioEvento_NivelAcesso_idx` (`idNivelAcesso`),
  CONSTRAINT `fkUsuarioEvento_Evento` FOREIGN KEY (`idEvento`) REFERENCES `Evento` (`idEvento`) ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioEvento_NivelAcesso` FOREIGN KEY (`idNivelAcesso`) REFERENCES `NivelAcesso` (`idNivelAcesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioEvento_StatusInscricao` FOREIGN KEY (`idStatusInscricao`) REFERENCES `StatusInscricao` (`idStatusInscricao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioEvento_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Associa os usuários inscritos e o evento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioEvento`
--

LOCK TABLES `UsuarioEvento` WRITE;
/*!40000 ALTER TABLE `UsuarioEvento` DISABLE KEYS */;
INSERT INTO `UsuarioEvento` VALUES (1,2,1,1,2,0),(2,2,4,1,2,0),(3,3,1,1,2,0),(4,3,4,4,2,0),(5,2,5,3,2,0),(6,16,5,3,2,0);
/*!40000 ALTER TABLE `UsuarioEvento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsuarioTrabalho`
--

DROP TABLE IF EXISTS `UsuarioTrabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsuarioTrabalho` (
  `idUsuarioTrabalho` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idTrabalho` int(11) NOT NULL,
  `orientador` int(11) unsigned zerofill NOT NULL COMMENT 'Flag para indicar se o usuário é orientador (1) do trabalho, ou não (0)',
  PRIMARY KEY (`idUsuarioTrabalho`),
  KEY `fkUsuarioTrabalho_Usuario_idx` (`idUsuario`),
  KEY `fkUsuarioTrabalho_Trabalho_idx` (`idTrabalho`),
  CONSTRAINT `fkUsuarioTrabalho_Trabalho` FOREIGN KEY (`idTrabalho`) REFERENCES `Trabalho` (`idTrabalho`) ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioTrabalho_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='Relaciona os usuários autores de um dado trabalho submetido.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioTrabalho`
--

LOCK TABLES `UsuarioTrabalho` WRITE;
/*!40000 ALTER TABLE `UsuarioTrabalho` DISABLE KEYS */;
INSERT INTO `UsuarioTrabalho` VALUES (1,1,1,00000000001),(2,2,1,00000000001),(3,3,1,00000000000),(4,2,9,00000000001),(5,3,9,00000000000),(6,2,10,00000000000),(7,3,10,00000000000),(8,2,11,00000000000),(9,3,11,00000000000),(10,3,12,00000000001),(11,2,12,00000000001),(12,2,13,00000000001),(13,3,13,00000000000),(14,2,14,00000000001),(15,3,14,00000000000),(16,2,15,00000000001),(17,3,15,00000000000),(18,3,16,00000000001),(19,2,16,00000000000),(20,2,17,00000000000),(21,2,18,00000000000),(22,2,19,00000000000),(23,2,20,00000000001),(24,16,20,00000000000);
/*!40000 ALTER TABLE `UsuarioTrabalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sistemaifrnsc'
--

--
-- Dumping routines for database 'sistemaifrnsc'
--
/*!50003 DROP PROCEDURE IF EXISTS `alterarAvaliadoresAdms` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alterarAvaliadoresAdms`(IN pIdUsuarios VARCHAR(50), IN pAvaliadores VARCHAR(50), IN pAdms VARCHAR(50))
BEGIN

-- USADOS NO LOOP PELAS LISTAS (RECEBIDAS POR PARÂMETRO)
	DECLARE _nextId TEXT DEFAULT NULL;
	DECLARE _nextAv TEXT DEFAULT NULL;
	DECLARE _nextAd TEXT DEFAULT NULL;
	DECLARE _nextlenId INT DEFAULT NULL;
	DECLARE _nextlenAv INT DEFAULT NULL;
	DECLARE _nextlenAd INT DEFAULT NULL;
	DECLARE _valueId TEXT DEFAULT NULL;
	DECLARE _valueAv TEXT DEFAULT NULL;
	DECLARE _valueAd TEXT DEFAULT NULL;
    
	-- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		
    -- LAÇO QUE EXECUTARÁ A ALTERAÇÃO PARA CADA idUsuarios
	iterator:
	LOOP
      
	  -- ENCERRA O LOOP CASO A LISTA ESTEJA VAZIA;
	  IF LENGTH(TRIM(pIdUsuarios)) = 0 OR pIdUsuarios IS NULL THEN
		LEAVE iterator;
	  END IF;

	  -- CAPITURA O PRÓXIMO VALOR DA LISTA (VALORES SEPARADOS POR VÍRGULA)
	  SET _nextId = SUBSTRING_INDEX(pIdUsuarios,',',1);
	  SET _nextAv = SUBSTRING_INDEX(pAvaliadores,',',1);
	  SET _nextAd = SUBSTRING_INDEX(pAdms,',',1);

	  -- SALVA O TAMANHO (EM CARACTERES) DO VALOR CAPTURADO
	  -- PARA QUE O VALOR INSERIDO POSSA SER REMOVIDO POSTERIORMENTE
	  SET _nextlenId = LENGTH(_nextId);
	  SET _nextlenAv = LENGTH(_nextAv);
	  SET _nextlenAd = LENGTH(_nextAd);

	  -- TRIM DO VALOR, EM CASO DE ESPAÇOS EM BRANCO
	  SET _valueId = TRIM(_nextId);
	  SET _valueAv = TRIM(_nextAv);
	  SET _valueAd = TRIM(_nextAd);

	  -- UPDATE NA TABELA
	  UPDATE Usuario
		SET
		avaliador = _valueAv,
		administrador = _valueAd
		WHERE idUsuario = _valueId;

	  SET pIdUsuarios = INSERT(pIdUsuarios,1,_nextlenId + 1,'');
	  SET pAvaliadores = INSERT(pAvaliadores,1,_nextlenAv + 1,'');
	  SET pAdms = INSERT(pAdms,1,_nextlenAd + 1,'');
	END LOOP;
    commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alterarStatusInscricao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alterarStatusInscricao`(in pId INT, in pDescricao VARCHAR(450))
BEGIN
	UPDATE StatusInscricao
    SET descricao = pDescricao
    WHERE idStatusInscricao = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alterarStatusTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alterarStatusTrabalho`(in pId INT, in pDescricao VARCHAR(450))
BEGIN
	UPDATE statusTrabalho
    SET descricao = pDescricao
    WHERE idStatusTrabalho = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alterarUsuarioAvaliador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alterarUsuarioAvaliador`(in pIdUsuario INT)
BEGIN
	DECLARE varAvaliador int;
    
    SELECT avaliador into varAvaliador from Usuario where idUsuario = pIdUsuario;
    IF varAvaliador = 0 THEN
		SET varAvaliador = 1;
	ELSE
		SET varAvaliador = 0;
    END IF;
    
	UPDATE usuario
	SET
	avaliador = varAvaliador
	WHERE `idUsuario` = pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `avaliarTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `avaliarTrabalho`(in pIdUsuarioAvaliacao INT, in pIdAvaliacao INT, in pNota DOUBLE, in pComentario TEXT(5000), in pFinalizado INT)
BEGIN
	
    DECLARE varAvaliacoesFinalizadas INT;
    -- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		IF pFinalizado = 1 THEN
			SELECT avaliacoesFinalizadas into varAvaliacoesFinalizadas from AvaliacaoTrabalho where idAvaliacaoTrabalho=pIdAvaliacao;
			SET varAvaliacoesFinalizadas = varAvaliacoesFinalizadas + 1;
			UPDATE AvaliacaoTrabalho
				SET avaliacoesFinalizadas = varAvaliacoesFinalizadas
				WHERE idAvaliacaoTrabalho=pIdAvaliacao;
		END IF;
		
        UPDATE UsuarioAvaliacao
		SET
			nota = pNota,
            comentario = pComentario,
            finalizado = pFinalizado
		WHERE
			idUsuarioAvaliacao = pIdUsuarioAvaliacao;
    
	COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarAnexo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarAnexo`(IN pIdEvento INT, IN pIdTipoAnexo INT, IN pArquivo VARCHAR(50), IN pDescricao VARCHAR(100))
BEGIN
	INSERT INTO EventoTipoAnexo (idEvento, idTipoAnexo, arquivo, descricao) 
    VALUES (pIdEvento, pIdTipoAnexo, pArquivo, pDescricao);
    
    SELECT LAST_INSERT_ID() as idEventoTipoAnexo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarAreasTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarAreasTrabalho`(in pIdTrabalho INT,
											in pIdsAreaAtuacao VARCHAR(50))
BEGIN
	-- USADOS NO LOOP PELOS IDs DAS ÁREAS DE ATUAÇÃO
	DECLARE _next TEXT DEFAULT NULL;
	DECLARE _nextlen INT DEFAULT NULL;
	DECLARE _value TEXT DEFAULT NULL;
    
    -- USADA PARA VERIFICAR SE A ÁREA JÁ ESTÁ ASSOCIADA AO TRABALHO
    DECLARE varAreaCadastrada INT;

	-- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		
    -- LAÇO QUE RELACIONA AS ÁREAS DE ATUAÇÃO DO TRABALHO
	iterator:
	LOOP
      
      SET varAreaCadastrada = 0;
	  -- ENCERRA O LOOP CASO A LISTA ESTEJA VAZIA;
	  IF LENGTH(TRIM(pIdsAreaAtuacao)) = 0 OR pIdsAreaAtuacao IS NULL THEN
		LEAVE iterator;
	  END IF;

	  -- CAPITURA O PRÓXIMO VALOR DA LISTA (VALORES SEPARADOS POR VÍRGULA)
	  SET _next = SUBSTRING_INDEX(pIdsAreaAtuacao,',',1);

	  -- SALVA O TAMANHO (EM CARACTERES) DO VALOR CAPTURADO
	  -- PARA QUE O VALOR INSERIDO POSSA SER REMOVIDO POSTERIORMENTE
	  SET _nextlen = LENGTH(_next);

	  -- TRIM DO VALOR, EM CASO DE ESPAÇOS EM BRANCO
	  SET _value = TRIM(_next);

      SELECT idTrabalhoArea into varAreaCadastrada from TrabalhoArea where idTrabalho=pIdTrabalho AND idAreaAtuacao=_value;
	  -- SE JÁ ESTIVER CADASTRADO, PULA A INSERÇÃO
      IF (varAreaCadastrada = 0 OR varAreaCadastrada IS NULL) THEN
		-- INSERE O VALOR EXTRAÍDO NA TABELA
		insert into TrabalhoArea (idTrabalho, idAreaAtuacao) values (pIdTrabalho, _value);
	  END IF;
      
	  -- REMOVE O VALOR INSERIDO DA LISTA
	  SET pIdsAreaAtuacao = INSERT(pIdsAreaAtuacao,1,_nextlen + 1,'');
	END LOOP;
    commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarAreasUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarAreasUsuario`(in pIdUsuario INT,
											in pIdsAreaAtuacao VARCHAR(50))
BEGIN
	-- USADOS NO LOOP PELOS IDs DAS ÁREAS DE ATUAÇÃO
	DECLARE _next TEXT DEFAULT NULL;
	DECLARE _nextlen INT DEFAULT NULL;
	DECLARE _value TEXT DEFAULT NULL;
    
    -- USADA PARA VERIFICAR SE A ÁREA JÁ ESTÁ ASSOCIADA AO USUÁRIO
    DECLARE varAreaCadastrada INT;

	-- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		
    -- LAÇO QUE RELACIONA AS ÁREAS DE ATUAÇÃO DO USUÁRIO
	iterator:
	LOOP
      
      SET varAreaCadastrada = 0;
	  -- ENCERRA O LOOP CASO A LISTA ESTEJA VAZIA;
	  IF LENGTH(TRIM(pIdsAreaAtuacao)) = 0 OR pIdsAreaAtuacao IS NULL THEN
		LEAVE iterator;
	  END IF;

	  -- CAPITURA O PRÓXIMO VALOR DA LISTA (VALORES SEPARADOS POR VÍRGULA)
	  SET _next = SUBSTRING_INDEX(pIdsAreaAtuacao,',',1);

	  -- SALVA O TAMANHO (EM CARACTERES) DO VALOR CAPTURADO
	  -- PARA Q POSSA SER REMOVIDO POSTERIORMENTE
	  SET _nextlen = LENGTH(_next);

	  -- TRIM O VALOR, EM CASO DE ESPAÇOS EM BRANCO
	  SET _value = TRIM(_next);

      SELECT idUsuarioArea into varAreaCadastrada from UsuarioArea where idUsuario=pIdUsuario AND idAreaAtuacao=_value;
	  -- SE JÁ ESTIVER CADASTRADO, PULA A INSERÇÃO
      IF (varAreaCadastrada = 0 OR varAreaCadastrada IS NULL) THEN
		-- INSERE O VALOR EXTRAÍDO NA TABELA
		insert into UsuarioArea (idUsuario, idAreaAtuacao) values (pIdUsuario, _value);
	  END IF;
      
	  -- REMOVE O VALOR INSERIDO DA LISTA
	  SET pIdsAreaAtuacao = INSERT(pIdsAreaAtuacao,1,_nextlen + 1,'');
	END LOOP;
    commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarAvaliacao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarAvaliacao`(in pIdTrabalho int, in pEhFinal int,
									  in pIdUsuarios mediumtext)
BEGIN

	-- RECUPERA A ÚLTIMA AVALIAÇÃO CADASTRADA
	declare lastId int; 
    
    DECLARE varNumAvaliadores int;
    
    -- USADOS NO LOOP PELOS IDs DOS USUÁRIOS
	DECLARE _next TEXT DEFAULT NULL;
	DECLARE _nextlen INT DEFAULT NULL;
	DECLARE _value TEXT DEFAULT NULL;

	-- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		
        -- INSERE O NOVO TRABALHO
		insert into AvaliacaoTrabalho (idTrabalho, ehFinal) values
							 (pIdTrabalho, pEhFinal);
		
        -- RECUPERA O ID INSERIDO
        set lastId = LAST_INSERT_ID();
        SET varNumAvaliadores = 0;
		
        -- LAÇO QUE RELACIONA OS USUÁRIOS QUE DESENVOLVERAM O TRABALHO
		iterator:
		LOOP
		  -- ENCERRA O LOOP CASO A LISTA ESTEJA VAZIA;
		  IF LENGTH(TRIM(pIdUsuarios)) = 0 OR pIdUsuarios IS NULL THEN
			LEAVE iterator;
		  END IF;

		  -- CAPITURA O PRÓXIMO VALOR DA LISTA (VALORES SEPARADOS POR VÍRGULA)
		  SET _next = SUBSTRING_INDEX(pIdUsuarios,',',1);

		  -- SALVA O TAMANHO (EM CARACTERES) DO VALOR CAPTURADO
		  -- PARA Q POSSA SER REMOVIDO POSTERIORMENTE
		  SET _nextlen = LENGTH(_next);

		  -- TRIM O VALOR, EM CASO DE ESPAÇOS EM BRANCO
		  SET _value = TRIM(_next);

		  -- INSERE O VALOR EXTRAÍDO NA TABELA
		  insert into UsuarioAvaliacao (idUsuario, idAvaliacao, finalizado) values (_next, lastId, 0);
          SET varNumAvaliadores = varNumAvaliadores + 1;

		  -- REMOVE O VALOR INSERIDO DA LISTA
		  SET pIdUsuarios = INSERT(pIdUsuarios,1,_nextlen + 1,'');
		END LOOP;
        
        UPDATE AvaliacaoTrabalho
			SET
				numAvaliadores = varNumAvaliadores
			WHERE idAvaliacaoTrabalho = lastId;
        
		UPDATE trabalho
			SET
				idStatusTrabalho = (SELECT idStatusTrabalho FROM statustrabalho where descricao='Em avaliacao')
			WHERE `idTrabalho` = pIdTrabalho;
        
        commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarEvento`(in pIdEvento int, in pIdEventoPrincipal int, 
									in pNome varchar(450), in pDescricao text(1000),
									in pLocal text(1000),
                                    in pNumVagas integer, in pInicioInscricao date,
                                    in pFinalInscricao date, in pInicioSubmissao VARCHAR(10), 
                                    in pFinalSubmissao VARCHAR(10), in pInicioEvento date, in pFinalEvento date)
BEGIN
	SET @idEventoPrincipal = NULL;
    SET @inicioSubmissao = NULL;
    SET @fimSubmissao = NULL;
	IF(pIdEventoPrincipal <> 0) THEN
		SET @idEventoPrincipal = pIdEventoPrincipal;
	END IF;
	IF(pInicioSubmissao <> '') THEN
		SET @inicioSubmissao = pInicioSubmissao;
	END IF;
	IF(pFinalSubmissao <> '') THEN
		SET @fimSubmissao = pFinalSubmissao;
	END IF;
	IF(pIdEvento = 0) THEN
		insert into Evento (idEventoPrincipal, nome, descricao,
							`local`,
							numVagas, inicioInscricao,
							finalInscricao, inicioSubmissao,
							finalSubmissao, inicioEvento, finalEvento)
					values
							(@idEventoPrincipal, pNome, pDescricao,
							pLocal,
							pNumVagas, pInicioInscricao,
							pFinalInscricao, @inicioSubmissao,
							@fimSubmissao, pInicioEvento, pFinalEvento);
		SELECT LAST_INSERT_ID() as idEvento;
	ELSE
		UPDATE `sistemaifrnsc`.`Evento`
		SET
			`nome` = pNome,
			`descricao` = pDescricao,
			`local` = pLocal,
			`numVagas` = pNumVagas,
			`inicioInscricao` = pInicioInscricao,
			`finalInscricao` = pFinalInscricao,
			`inicioSubmissao` = @inicioSubmissao,
			`finalSubmissao` = @fimSubmissao,
			`inicioEvento` = pInicioEvento,
			`finalEvento` = pFinalEvento,
			`idEventoPrincipal` = @idEventoPrincipal
		WHERE `idEvento` = pIdEvento;
    	SELECT pIdEvento as idEvento;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarNivelAcesso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarNivelAcesso`(in pDescricao varchar(450))
BEGIN
	insert into nivelAcesso (descricao) values (pDescricao);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarStatusInscricao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarStatusInscricao`(in pDescricao VARCHAR(450))
BEGIN
	insert into StatusInscricao (descricao) values (pDescricao);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarStatusTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarStatusTrabalho`(in pDescricao varchar(450))
BEGIN

	insert into StatusTrabalho (descricao) values (pDescricao);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarTrabalho`(IN pIdTrabalho INT, IN pIdEvento INT, IN pIdStatus INT, IN pInstituicao VARCHAR(450)
										, IN pTitulo VARCHAR(450), IN pResumo TEXT(5000), IN pPalavrasChave VARCHAR(100)
                                        , IN pArquivo VARCHAR(500), IN pIdsAreaAtuacao VARCHAR(50), IN pIdsOrientadores VARCHAR(50)
                                        , IN pIdsDemaisAutores VARCHAR(50))
BEGIN
	IF(pIdTrabalho = 0) THEN
		insert into Trabalho (idEvento, idStatusTrabalho, instituicao, titulo, resumo, palavrasChave, arquivo)
					values (pIdEvento, pIdStatus, pInstituicao, pTitulo, pResumo, pPalavrasChave, pArquivo);
		
		SET pIdTrabalho = LAST_INSERT_ID();
	ELSE
		update Trabalho
           SET idStatusTrabalho=pIdStatus,
			   instituicao=pInstituicao,
               titulo=pTitulo,
               resumo=pResumo,
               palavrasChave=pPalavrasChave,
               arquivo=parquivo
		 WHERE idTrabalho=pIdTrabalho;
         
        /*SET pIdTrabalho = idTrabalho;*/
	END IF;
    
    commit;
    
    CALL cadastrarUsuariosTrabalho(pIdTrabalho, pIdsOrientadores, 1);
    CALL cadastrarUsuariosTrabalho(pIdTrabalho, pIdsDemaisAutores, 0);
    
    CALL cadastrarAreasTrabalho(pIdTrabalho, pIdsAreaAtuacao);
    
    SELECT pIdTrabalho as idTrabalho;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarUsuario`(in pCpf varchar(14), in pSenha varchar(32),
									 in pNome varchar(450), in pEmail varchar(450),
                                     in pMatricula varchar(100), in pAvaliador integer,
                                     in pImagem varchar(50), in pAdm integer,
                                     in pIdUsuario integer, in pIdsAreaAtuacao varchar(50),
                                     in pLattes varchar(100))
BEGIN

	IF(pIdUsuario = 0) THEN
		insert into Usuario (cpf, senha, nome, email, matricula, avaliador, imagem, administrador, lattes)
					values (pCpf, pSenha, pNome, pEmail, pMatricula, pAvaliador, pImagem, pAdm, pLattes);
		
		SET pIdUsuario = LAST_INSERT_ID();
        #SELECT LAST_INSERT_ID() as idUsuario;
	END IF;
    
    commit;
    CALL cadastrarAreasUsuario(pIdUsuario, pIdsAreaAtuacao);
    
    SELECT pIdUsuario as idUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarUsuariosTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarUsuariosTrabalho`(in pIdTrabalho INT,
											in pIdsUsuario VARCHAR(50),
											in pOrientador INT)
BEGIN
	-- USADOS NO LOOP PELOS IDs DOS USUÁRIO
	DECLARE _next TEXT DEFAULT NULL;
	DECLARE _nextlen INT DEFAULT NULL;
	DECLARE _value TEXT DEFAULT NULL;
    
    -- USADA PARA VERIFICAR SE O USUÁRIO JÁ ESTÁ ASSOCIADO AO TRABALHO
    DECLARE varUsuarioCadastrado INT;

	-- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		
    -- LAÇO QUE RELACIONA OS USUÁRIOS DO TRABALHO
	iterator:
	LOOP
      
      SET varUsuarioCadastrado = 0;
	  -- ENCERRA O LOOP CASO A LISTA ESTEJA VAZIA;
	  IF LENGTH(TRIM(pIdsUsuario)) = 0 OR pIdsUsuario IS NULL THEN
		LEAVE iterator;
	  END IF;

	  -- CAPITURA O PRÓXIMO VALOR DA LISTA (VALORES SEPARADOS POR VÍRGULA)
	  SET _next = SUBSTRING_INDEX(pIdsUsuario,',',1);

	  -- SALVA O TAMANHO (EM CARACTERES) DO VALOR CAPTURADO
	  -- PARA QUE O VALOR INSERIDO POSSA SER REMOVIDO POSTERIORMENTE
	  SET _nextlen = LENGTH(_next);

	  -- TRIM DO VALOR, EM CASO DE ESPAÇOS EM BRANCO
	  SET _value = TRIM(_next);

      SELECT idUsuarioTrabalho into varUsuarioCadastrado from UsuarioTrabalho where idTrabalho=pIdTrabalho AND idUsuario=_value;
	  -- SE JÁ ESTIVER CADASTRADO, PULA A INSERÇÃO
      IF (varUsuarioCadastrado = 0 OR varUsuarioCadastrado IS NULL) THEN
		-- INSERE O VALOR EXTRAÍDO NA TABELA
		insert into UsuarioTrabalho (idTrabalho, idUsuario, orientador) values (pIdTrabalho, _value, pOrientador);
	  END IF;
      
	  -- REMOVE O VALOR INSERIDO DA LISTA
	  SET pIdsUsuario = INSERT(pIdsUsuario,1,_nextlen + 1,'');
	END LOOP;
    commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarAnexosPorEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarAnexosPorEvento`(IN pIdEvento INT, IN pIdTipoAnexo INT)
BEGIN
	SET @instrucao = 'select e.idEventoTipoAnexo, e.idEvento, e.idTipoAnexo, e.arquivo, e.descricao 
					    from EventoTipoAnexo e
					   where e.idEvento=';
	
    SET @instrucao = CONCAT(@instrucao, pIdEvento);
	IF(pIdTipoAnexo > 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.idTipoAnexo=', pIdTipoAnexo);
	END IF;
    
    PREPARE stmt FROM @instrucao;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarAreaAtuacao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarAreaAtuacao`(in pId INT, in pDescricao VARCHAR(450))
BEGIN
    IF(pId = 0 AND pDescricao = '') THEN
		SELECT idAreaAtuacao, area FROM AreaAtuacao ORDER BY area;
    ELSE
		IF(pId > 0 AND pDescricao <> '') THEN
			SELECT idAreaAtuacao, area FROM AreaAtuacao
			WHERE idAreaAtuacao=pId
			  AND LOWER(area) like LOWER(concat('%', pDescricao, '%'))
			ORDER BY area;
        ELSE
			IF(pDescricao <> '') THEN
				SELECT idAreaAtuacao, area FROM AreaAtuacao
                WHERE LOWER(area) like LOWER(concat('%', pDescricao, '%'))
				ORDER BY area;
            ELSE
            
				SELECT idAreaAtuacao, area FROM AreaAtuacao
					WHERE idAreaAtuacao=pId
                     ORDER BY area;

            END IF;
			
        END IF;
    
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarAreasPorIdUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarAreasPorIdUsuario`(IN pIdUsuario INT)
BEGIN
	SELECT idUsuarioArea, idUsuario, idAreaAtuacao FROM UsuarioArea
    WHERE idUsuario=pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarAvaliacao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarAvaliacao`(IN pIdEvento INT, IN pIdTrabalho INT, IN pIdAvaliacao INT,
										IN pIdUsuario INT, IN pIdStatusTrabalho INT, IN pConcluida INT,
                                        IN pEhFinal INT, IN pTitulo VARCHAR(450), IN pResumo TEXT(5000))
BEGIN
	SET @instrucao = 'SELECT av.idAvaliacaoTrabalho,
						   av.idTrabalho,
						   av.ehFinal,
						   av.numAvaliadores,
						   av.avaliacoesFinalizadas,
						   t.titulo,
						   t.resumo,
						   t.arquivo,
						   t.idEvento,
						   t.idStatusTrabalho,
						   usuario.nome
					  FROM avaliacaotrabalho av,
						   trabalho t,
						   usuarioavaliacao u,
						   usuario
					 WHERE av.idTrabalho=t.idTrabalho
					   AND av.idAvaliacaoTrabalho=u.idAvaliacao
					   AND u.idUsuario = usuario.idUsuario';
	IF (pIdEvento <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND t.idEvento=', pIdEvento);
    END IF;
    IF (pIdTrabalho <> 0) THEN
    	SET @instrucao = CONCAT(@instrucao, ' AND av.idTrabalho=', pIdTrabalho);
    END IF;
    IF (pIdAvaliacao <> 0) THEN
    	SET @instrucao = CONCAT(@instrucao, ' AND av.idAvaliacaoTrabalho=', pIdAvaliacao);
    END IF;
    IF (pIdusuario <> 0) THEN
    	SET @instrucao = CONCAT(@instrucao, ' AND av.idAvaliacaoTrabalho in (select idAvaliacao from usuarioavaliacao where idUsuario=', pIdusuario, ')');
    END IF;
    IF (pIdStatusTrabalho <> 0) THEN
    	SET @instrucao = CONCAT(@instrucao, ' AND t.idStatusTrabalho=', pIdStatusTrabalho);
    END IF;
    IF (pConcluida = 0 OR pConcluida = 1) THEN
		IF (pConcluida = 0) THEN	#QUANDO A AVALIAÇÃO AINDA NÃO FOI CONCLUÍDA
			SET @instrucao = CONCAT(@instrucao, ' AND av.avaliacoesFinalizadas<>av.numAvaliadores');
		ELSE						#QUANDO A AVALIAÇÃO ESTÁ CONCLUÍDA
			SET @instrucao = CONCAT(@instrucao, ' AND av.avaliacoesFinalizadas=av.numAvaliadores');
		END IF;
    END IF;
    IF (pEhFinal = 0 OR pEhFinal = 1) THEN    
		SET @instrucao = CONCAT(@instrucao, ' AND av.ehFinal=', pEhFinal);
    END IF;
    IF (pTitulo <> '') THEN
    	SET @instrucao = CONCAT(@instrucao, ' AND LOWER(t.titulo) LIKE LOWER(\'%', pTitulo, '%\')');
    END IF;
    IF (pResumo <> '') THEN
    	SET @instrucao = CONCAT(@instrucao, ' AND LOWER(t.resumo) LIKE LOWER(\'%', pResumo, '%\')');
    END IF;
    
    PREPARE stmt FROM @instrucao;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarEvento`(in pIdEvento int,
									in pNome varchar(450), in pDescricao text(1000), in pInicioInscricao varchar(10),
                                    in pFinalInscricao varchar(10), in pInicioSubmissao varchar(10), 
                                    in pFinalSubmissao varchar(10), in pInicioEvento varchar(10),
                                    in pFinalEvento varchar(10), in pIdEventoPrincipal int)
BEGIN
	SET @instrucao = 'SELECT e.idEvento, e.nome, e.descricao, e.local,
  						     e.numVagas, e.inicioInscricao,
						     e.finalInscricao, e.inicioSubmissao, e.finalSubmissao,
						     e.inicioEvento, e.finalEvento, e.idEventoPrincipal
					  FROM Evento e WHERE e.idEvento=e.idEvento';
	IF (pIdEventoPrincipal > 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.idEventoPrincipal =', pIdEventoPrincipal);
    ELSE
		IF (pIdEventoPrincipal = 0) THEN
			SET @instrucao = CONCAT(@instrucao, ' AND e.idEventoPrincipal is null');
        END IF;
    END IF;
	IF (pIdEvento <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.idEvento=', pIdEvento);
    END IF;
    IF (pNome <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND LOWER(e.nome) LIKE LOWER(\'%', pNome, '%\')');
    END IF;
    IF (pDescricao <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND LOWER(e.descricao) LIKE LOWER(\'%', pDescricao, '%\')');
    END IF;
    IF (pInicioInscricao <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.inicioInscricao>=', pInicioInscricao);
    END IF;
    IF (pFinalInscricao <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.finalInscricao<=', pFinalInscricao);
    END IF;
    IF (pInicioSubmissao <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.inicioSubmissao>=', pInicioSubmissao);
    END IF;
    IF (pFinalSubmissao <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.finalSubmissao<=', pFinalSubmissao);
    END IF;
    IF (pInicioEvento <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.inicioEvento>=', pInicioEvento);
    END IF;
    IF (pFinalEvento <> '') THEN
		SET @instrucao = CONCAT(@instrucao, ' AND e.finalEvento<=', pFinalEvento);
    END IF;
    
    PREPARE stmt FROM @instrucao;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarInscritosPorEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarInscritosPorEvento`(IN pIdEvento INTEGER, IN pIdStatusInscricao INTEGER)
BEGIN
	SELECT u.idUsuario,
		   u.cpf,
           u.nome,
           u.email,
           u.imagem
	  FROM Usuario u,
		   UsuarioEvento e
	 WHERE e.idUsuario = u.idUsuario
       AND e.idStatusInscricao = pIdStatusInscricao
	   AND e.idEvento = pIdEvento;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarNivelAcesso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarNivelAcesso`(in pId INT, in pDescricao VARCHAR(450))
BEGIN
	IF(pId = 0 AND pDescricao = '') THEN
		SELECT idNivelAcesso, descricao FROM nivelAcesso;
    ELSE
		IF(pId > 0 AND pDescricao <> '') THEN
			SELECT idNivelAcesso, descricao FROM nivelAcesso
			WHERE idNivelAcesso=pId
			  AND LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
        ELSE
			IF(pDescricao <> '') THEN
				SELECT idNivelAcesso, descricao FROM nivelAcesso
                WHERE LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
            ELSE
            
				SELECT idNivelAcesso, descricao FROM nivelAcesso
					WHERE idNivelAcesso=pId;

            END IF;
			
        END IF;
    
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarStatusInscricao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarStatusInscricao`(in pId INT, in pDescricao VARCHAR(450))
BEGIN
	IF(pId = 0 AND pDescricao = '') THEN
		SELECT idStatusInscricao, descricao FROM StatusInscricao;
    ELSE
		IF(pId > 0 AND pDescricao <> '') THEN
			SELECT idStatusInscricao, descricao FROM StatusInscricao
			WHERE idStatusInscricao=pId
			  AND LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
        ELSE
			IF(pDescricao <> '') THEN
				SELECT idStatusInscricao, descricao FROM StatusInscricao
                WHERE LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
            ELSE
            
				SELECT idStatusInscricao, descricao FROM StatusInscricao
					WHERE idStatusInscricao=pId;

            END IF;
			
        END IF;
    
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarStatusTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarStatusTrabalho`(in pId INT, in pDescricao VARCHAR(450))
BEGIN
	IF(pId = 0 AND pDescricao = '') THEN
		SELECT idStatusTrabalho, descricao FROM StatusTrabalho;
    ELSE
		IF(pId > 0 AND pDescricao <> '') THEN
			SELECT idStatusTrabalho, descricao FROM StatusTrabalho
			WHERE idStatusTrabalho=pId
			  AND LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
        ELSE
			IF(pDescricao <> '') THEN
				SELECT idStatusTrabalho, descricao FROM StatusTrabalho
                WHERE LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
            ELSE
            
				SELECT idStatusTrabalho, descricao FROM StatusTrabalho
					WHERE idStatusTrabalho=pId;

            END IF;
			
        END IF;
    
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarTrabalhosPorUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarTrabalhosPorUsuario`(IN pIdUsuario INTEGER)
BEGIN	
	SELECT t.idTrabalho, 
		   t.titulo, 
		   t.resumo, 
		   t.arquivo, 
		   t.idEvento, 
		   t.idStatusTrabalho, 
		   t.palavrasChave, 
		   t.instituicao 
	from Trabalho t,
		 UsuarioTrabalho ut
	where t.idTrabalho=ut.idTrabalho 
	  and ut.idUsuario=pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarUsuario`(in pCpf varchar(14),
									 in pNome varchar(450), in pEmail varchar(450),
                                     in pMatricula varchar(100), in pAvaliador integer,
                                     in pAdm integer, in pIdUsuario integer)
BEGIN
	SET @clausula = 1;
	SET @instrucao = 'SELECT idUsuario, cpf, senha, nome, email, matricula, imagem, administrador, avaliador
					    FROM Usuario';
                        
	IF (pIdUsuario <> 0) THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' idUsuario=', pIdUsuario);
    END IF;
    IF (pCpf <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' cpf=\'', pCpf, '\'');
    END IF;
    IF (pNome <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' LOWER(nome) LIKE LOWER(\'%', pNome, '%\')');
    END IF;
    IF (pEmail <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' LOWER(email) LIKE LOWER(\'%', pEmail, '%\')');
    END IF;
    IF (pMatricula <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' matricula=\'', pMatricula, '\'');
    END IF;
    IF (pAdm <> -1) THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' administrador=', pAdm);
    END IF;
    IF (pAvaliador <> -1) THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' AND ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' avaliador=', pAvaliador);
    END IF;
    
    #SELECT @instrucao as instrucao;
    PREPARE stmt FROM @instrucao;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultarUsuarioEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarUsuarioEvento`(in pIdUsuario int, in pIdEvento int,
											in pIdStatusInscricao int,
                                            in pIdNivelAcesso int)
BEGIN
	SET @instrucao = 'SELECT idUsuarioEvento,
							 idUsuario,
                             idEvento,
                             idStatusInscricao,
                             idNivelAcesso
					    FROM UsuarioEvento
					   WHERE idUsuarioEvento=idUsuarioEvento';
	IF (pIdUsuario <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND idUsuario=', pIdUsuario);
    END IF;
	IF (pIdEvento <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND idEvento=', pIdEvento);
    END IF;
	IF (pIdStatusInscricao <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND idStatusInscricao=', pIdStatusInscricao);
    END IF;
	IF (pIdNivelAcesso <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' AND idNivelAcesso=', pIdNivelAcesso);
    END IF;

    PREPARE stmt FROM @instrucao;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `credenciar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `credenciar`(IN pIdUsuario INTEGER, IN pIdEvento INTEGER)
BEGIN
	UPDATE UsuarioEvento 
       SET idStatusInscricao=4
	 WHERE idUsuario=pIdUsuario
       AND idEvento=pIdEvento;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `excluirEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `excluirEvento`(in pIdEvento INT)
BEGIN
	DELETE FROM UsuarioEvento WHERE idEvento = pIdEvento;
	DELETE FROM Evento WHERE idEvento = pIdEvento;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `excluirStatusInscricao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `excluirStatusInscricao`(in pId INT)
BEGIN
	delete from StatusInscricao where idStatusInscricao=pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `excluirStatusTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `excluirStatusTrabalho`(in pId INT)
BEGIN
	delete from StatusTrabalho where idStatusTrabalho=pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inscreverEmEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscreverEmEvento`(in pIdUsuario INT, in pIdEvento INT)
BEGIN
	insert UsuarioEvento (idUsuario, idEvento, idStatusInscricao, idNivelAcesso)
    values (pIdUsuario, pIdEvento, 
		(select idStatusInscricao from StatusInscricao where lower(descricao)='aguardando confirmação'),
        (select idNivelAcesso from NivelAcesso where lower(descricao)='organizador'));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(in pCpf varchar(14), in pSenha varchar(250))
BEGIN
	select
		u.idUsuario,
        u.cpf,
        u.senha,
		u.nome, 
		u.email,
		u.matricula, 
		u.avaliador,
        u.administrador,
        u.imagem
	from 
		Usuario u 
	where 
		u.cpf = pCpf and 
		u.senha = pSenha;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `submeterTrabalho` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `submeterTrabalho`(in pTitulo varchar(450), in pResumo text(5000),
									 in pArquivo varchar(100), in pIdEvento int,
                                     in pIdStatusTrabalho int, in pIdUsuarios mediumtext)
BEGIN

	-- RECUPERA O ÚLTIMO ID DE TRABALHO CADASTRADO
	declare lastId int; 
    
    -- USADOS NO LOOP PELOS IDs DOS USUÁRIOS
	DECLARE _next TEXT DEFAULT NULL;
	DECLARE _nextlen INT DEFAULT NULL;
	DECLARE _value TEXT DEFAULT NULL;

	-- CANCELA A TRANSAÇÃO EM CASO DE QUALQUER PROBLEMA
    DECLARE exit handler for sqlexception
	BEGIN
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;
		SELECT @p1 as RETURNED_SQLSTATE  , @p2 as MESSAGE_TEXT;
		ROLLBACK;
	END;
    
    -- INICIA A TRANSAÇÃO
    start transaction;
		
        -- INSERE O NOVO TRABALHO
		insert into Trabalho (titulo, resumo, arquivo, idEvento, idStatusTrabalho) values
							 (pTitulo, pResumo, pArquivo, pIdEvento, pIdStatusTrabalho);
		
        -- RECUPERA O ID INSERIDO
        set lastId = LAST_INSERT_ID();
		
        -- LAÇO QUE RELACIONA OS USUÁRIOS QUE DESENVOLVERAM O TRABALHO
		iterator:
		LOOP
		  -- ENCERRA O LOOP CASO A LISTA ESTEJA VAZIA;
		  IF LENGTH(TRIM(pIdUsuarios)) = 0 OR pIdUsuarios IS NULL THEN
			LEAVE iterator;
		  END IF;

		  -- CAPITURA O PRÓXIMO VALOR DA LISTA (VALORES SEPARADOS POR VÍRGULA)
		  SET _next = SUBSTRING_INDEX(pIdUsuarios,',',1);

		  -- SALVA O TAMANHO (EM CARACTERES) DO VALOR CAPTURADO
		  -- PARA Q POSSA SER REMOVIDO POSTERIORMENTE
		  SET _nextlen = LENGTH(_next);

		  -- TRIM O VALOR, EM CASO DE ESPAÇOS EM BRANCO
		  SET _value = TRIM(_next);

		  -- INSERE O VALOR EXTRAÍDO NA TABELA
		  insert into usuarioTrabalho (idUsuario, idTrabalho) values (_next, lastId);

		  -- REMOVE O VALOR INSERIDO DA LISTA
		  SET pIdUsuarios = INSERT(pIdUsuarios,1,_nextlen + 1,'');
		END LOOP;
        
        commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-23 21:17:15
