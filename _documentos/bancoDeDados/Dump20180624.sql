CREATE DATABASE  IF NOT EXISTS `sistemaifrnsc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistemaifrnsc`;
-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: sistemaifrnsc
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
  `logoMarca` varchar(150) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Nesta tabela são relacionados os eventos do sistema. É importante ressaltar que uma mostra tecnológica em uma Expotec, por exemplo, a mostra tecnológica é um subevento do evento Expotec. permitindo assim que para cada grande evento, suas mostras ou momentos possam ser relacionados de forma dinâmica e individualizados, facilitando a avaliação de trabalhos, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evento`
--

LOCK TABLES `Evento` WRITE;
/*!40000 ALTER TABLE `Evento` DISABLE KEYS */;
INSERT INTO `Evento` VALUES (1,'VII EXPOTEC IFRN-SC','Resumo do evento do ano passado','R. São Braz, 304 - Paraiso, Santa Cruz - RN, 59200-000','VII_EXPOTEC_IFRN-SC1.png',0,'2018-06-22','2018-06-30',NULL,NULL,'2018-07-12','2018-07-14',NULL),(2,'Teste 000','Evento de teste 000','Teste 000','',20,'2018-06-21','2018-06-23',NULL,NULL,'2018-07-25','2018-07-27',NULL),(3,'Teste 001','Evento de teste 001','Local de teste 001','',20,'2018-06-22','2018-06-29',NULL,NULL,'2018-07-02','2018-07-04',NULL),(4,'Minicurso C#','C# é uma linguagem de programação de alto nível desenvolvida pela Microsoft.','Laboratório 63','Minicurso_C1.png',10,'2018-06-22','2018-06-30','2018-06-22','2018-06-30','2018-07-27','2018-07-28',1);
/*!40000 ALTER TABLE `Evento` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Relaciona os níveis de acesso de usuário no sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NivelAcesso`
--

LOCK TABLES `NivelAcesso` WRITE;
/*!40000 ALTER TABLE `NivelAcesso` DISABLE KEYS */;
INSERT INTO `NivelAcesso` VALUES (1,'Participante'),(2,'Organizador');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Relaciona os possíveis status que uma inscrição pode sofrer em um dado evento.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StatusInscricao`
--

LOCK TABLES `StatusInscricao` WRITE;
/*!40000 ALTER TABLE `StatusInscricao` DISABLE KEYS */;
INSERT INTO `StatusInscricao` VALUES (1,'Confirmada'),(2,'Rejeitada'),(3,'Aguardando confirmação');
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
-- Table structure for table `Trabalho`
--

DROP TABLE IF EXISTS `Trabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trabalho` (
  `idTrabalho` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(450) NOT NULL,
  `resumo` text NOT NULL,
  `arquivo` varchar(500) DEFAULT NULL,
  `idEvento` int(11) NOT NULL,
  `idStatusTrabalho` int(11) NOT NULL,
  `palavrasChave` varchar(100) NOT NULL,
  PRIMARY KEY (`idTrabalho`),
  KEY `fkTrabalho_Evento_idx` (`idEvento`),
  KEY `fkTrabalho_StatusTrabalho_idx` (`idStatusTrabalho`),
  CONSTRAINT `fkTrabalho_Evento` FOREIGN KEY (`idEvento`) REFERENCES `Evento` (`idEvento`) ON UPDATE NO ACTION,
  CONSTRAINT `fkTrabalho_StatusTrabalho` FOREIGN KEY (`idStatusTrabalho`) REFERENCES `StatusTrabalho` (`idStatusTrabalho`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Lista os trabalhos cadastrados para o dado (sub) evento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trabalho`
--

LOCK TABLES `Trabalho` WRITE;
/*!40000 ALTER TABLE `Trabalho` DISABLE KEYS */;
INSERT INTO `Trabalho` VALUES (1,'Direto no banco','É só um teste','coisa.pdf',4,1,'teste, trabalho'),(2,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo'),(3,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo'),(4,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo'),(5,'Trabalho de teste 00','Resumo do trabalho de teste 00','4_2_Trabalho de teste 000.pdf',4,1,'trabalho, teste, resumo');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrabalhoArea`
--

LOCK TABLES `TrabalhoArea` WRITE;
/*!40000 ALTER TABLE `TrabalhoArea` DISABLE KEYS */;
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
  `Administrador` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Lista geral dos usuários (inscritos) cadastrados no sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'999.000.000-00','Senha123','Teste','teste9999_@teste.com','','',0,0),(2,'000.000.000-00','10a9c136d796bab18d3e144092a4f20a','Marcelo zero','marcelo00@teste.com','','00000000000.jpg',0,1),(3,'000.000.000-01','10a9c136d796bab18d3e144092a4f20a','Marcelo um','marcelo001@teste.com','','',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioArea`
--

LOCK TABLES `UsuarioArea` WRITE;
/*!40000 ALTER TABLE `UsuarioArea` DISABLE KEYS */;
INSERT INTO `UsuarioArea` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,20),(5,2,14),(6,2,17),(7,3,20),(8,3,9);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Associa os usuários inscritos e o evento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioEvento`
--

LOCK TABLES `UsuarioEvento` WRITE;
/*!40000 ALTER TABLE `UsuarioEvento` DISABLE KEYS */;
INSERT INTO `UsuarioEvento` VALUES (1,2,1,3,2,0),(2,2,4,3,2,0),(3,3,1,3,2,0),(4,3,4,3,2,0);
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
  PRIMARY KEY (`idUsuarioTrabalho`),
  KEY `fkUsuarioTrabalho_Usuario_idx` (`idUsuario`),
  KEY `fkUsuarioTrabalho_Trabalho_idx` (`idTrabalho`),
  CONSTRAINT `fkUsuarioTrabalho_Trabalho` FOREIGN KEY (`idTrabalho`) REFERENCES `Trabalho` (`idTrabalho`) ON UPDATE NO ACTION,
  CONSTRAINT `fkUsuarioTrabalho_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relaciona os usuários autores de um dado trabalho submetido.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioTrabalho`
--

LOCK TABLES `UsuarioTrabalho` WRITE;
/*!40000 ALTER TABLE `UsuarioTrabalho` DISABLE KEYS */;
/*!40000 ALTER TABLE `UsuarioTrabalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sistemaifrnsc'
--
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
									in pLocal text(1000), in pLogoMarca varchar(450),
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
							`local`, logoMarca,
							numVagas, inicioInscricao,
							finalInscricao, inicioSubmissao,
							finalSubmissao, inicioEvento, finalEvento)
					values
							(@idEventoPrincipal, pNome, pDescricao,
							pLocal, pLogoMarca,
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
			`logoMarca` = pLogoMarca,
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarTrabalho`(IN pIdTrabalho INT, IN pIdEvento INT, IN pIdStatus INT, IN pTitulo VARCHAR(450)
										, IN pResumo TEXT(5000), IN pPalavrasChave VARCHAR(100), IN pArquivo VARCHAR(500))
BEGIN
	IF(pIdTrabalho = 0) THEN
		insert into Trabalho (idEvento, idStatusTrabalho, titulo, resumo, palavrasChave, arquivo)
					values (pIdEvento, pIdStatus, pTitulo, pResumo, pPalavrasChave, pArquivo);
		
		SET pIdTrabalho = LAST_INSERT_ID();
	ELSE
		update Trabalho
           SET idStatusTrabalho=pIdStatus,
               titulo=pTitulo,
               resumo=pResumo,
               palavrasChave=pPalavrasChave,
               arquivo=parquivo
		 WHERE idTrabalho=pIdTrabalho;
         
        SET pIdTrabalho = idTrabalho;
	END IF;
    
    commit;
    /*
    CALL cadastrarUsuariosTrabalho(pIdTrabalho, pIdsUsuario);
    CALL cadastrarAreasTrabalho(pIdTrabalho, pIdsAreaAtuacao);
    */
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
                                     in pIdUsuario integer, in pIdsAreaAtuacao varchar(50))
BEGIN

	IF(pIdUsuario = 0) THEN
		insert into Usuario (cpf, senha, nome, email, matricula, avaliador, imagem, administrador)
					values (pCpf, pSenha, pNome, pEmail, pMatricula, pAvaliador, pImagem, pAdm);
		
		SET pIdUsuario = LAST_INSERT_ID();
        #SELECT LAST_INSERT_ID() as idUsuario;
	ELSE
		update Usuario
           SET senha=pSenha,
               nome=pNome,
               email=pEmail,
               matricula=pMatricula,
               avaliador=pAvaliador,
               imagem=pImagem,
               administrador=pAdm
		 WHERE idUsuario=pIdUsuario;
         
        SET pIdUsuario = idUsuario;
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
  						     e.logoMarca, e.numVagas, e.inicioInscricao,
						     e.finalInscricao, e.inicioSubmissao, e.finalSubmissao,
						     e.inicioEvento, e.finalEvento, e.idEventoPrincipal
					  FROM Evento e';
	IF (pIdEventoPrincipal <> 0) THEN
		SET @instrucao = CONCAT(@instrucao, ' WHERE e.idEventoPrincipal =', pIdEventoPrincipal);
    ELSE
        SET @instrucao = CONCAT(@instrucao, ' WHERE e.idEventoPrincipal is null');
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
/*!50003 DROP PROCEDURE IF EXISTS `consultarInscritosPorStatusInscricao` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarInscritosPorStatusInscricao`(in pIdEvento int,
														 in pIdStatusInscricao int)
BEGIN
	select
		u.idUsuario, 
		u.nome, 
		u.email, 
		u.matricula, 
		u.avaliador, 
		n.idNivelAcesso, 
		n.descricao as nivelAcesso, 
		s.idStatusInscricao, 
		s.descricao as statusInscricao
	from 
		Usuario u, 
		nivelAcesso n, 
		statusinscricao s,
		usuarioevento e
	where 
		e.idNivelAcesso = n.idNivelAcesso and
		e.idStatusInscricao = s.idStatusInscricao and
		e.idUsuario = u.idUsuario and
		e.idStatusInscricao = pIdStatusInscricao and
		e.idEvento = pIdEvento;
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
		SELECT idStatusTrabalho, descricao FROM statusTrabalho;
    ELSE
		IF(pId > 0 AND pDescricao <> '') THEN
			SELECT idStatusTrabalho, descricao FROM statusTrabalho
			WHERE idStatusTrabalho=pId
			  AND LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
        ELSE
			IF(pDescricao <> '') THEN
				SELECT idStatusTrabalho, descricao FROM statusTrabalho
                WHERE LOWER(descricao) like LOWER(concat('%', pDescricao, '%'));
            ELSE
            
				SELECT idStatusTrabalho, descricao FROM statusTrabalho
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
					    FROM Usuario
					   ';
	IF (pIdUsuario <> 0) THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' idUsuario=', pIdUsuario);
    END IF;
    IF (pCpf <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' cpf=\'', pCpf, '\'');
    END IF;
    IF (pNome <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' LOWER(nome) LIKE LOWER(\'%', pNome, '%\')');
    END IF;
    IF (pEmail <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' LOWER(email) LIKE LOWER(\'%', pEmail, '%\')');
    END IF;
    IF (pMatricula <> '') THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' matricula=\'', pMatricula, '\'');
    END IF;
    IF (pAdm <> -1) THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
		END IF;
		SET @instrucao = CONCAT(@instrucao, ' administrador=', pAdm);
    END IF;
    IF (pAvaliador <> -1) THEN
		IF(@clausula = 1) THEN
			SET @instrucao = CONCAT(@instrucao, ' WHERE ');
            SET @clausula = 0;
		ELSE
			SET @instrucao = CONCAT(@instrucao, ' OR ');
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

-- Dump completed on 2018-06-24 22:18:10
