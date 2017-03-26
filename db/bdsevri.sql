CREATE DATABASE  IF NOT EXISTS `bdsevri` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bdsevri`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: bdsevri
-- ------------------------------------------------------
-- Server version	5.5.36

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
-- Table structure for table `tbadministracionriesgo`
--

DROP TABLE IF EXISTS `tbadministracionriesgo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbadministracionriesgo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdAnalisisRiesgo` int(11) NOT NULL,
  `CedulaResposable` varchar(15) NOT NULL,
  `ActividadTratamiento` varchar(1000) NOT NULL,
  `PlazoTratamiento` date NOT NULL,
  `CategoriaActividad` varchar(100) NOT NULL,
  `CostoActividad` double NOT NULL,
  PRIMARY KEY (`Id`,`IdAnalisisRiesgo`,`CedulaResposable`),
  KEY `fk_tbAdministracionRiesgo_tbUsuario1_idx` (`CedulaResposable`),
  KEY `fk_tbAdministracionRiesgo_tbAnalisisRiesgo1_idx` (`IdAnalisisRiesgo`),
  CONSTRAINT `fk_tbAdministracionRiesgo_tbAnalisisRiesgo1` FOREIGN KEY (`IdAnalisisRiesgo`) REFERENCES `tbanalisisriesgo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbAdministracionRiesgo_tbUsuario1` FOREIGN KEY (`CedulaResposable`) REFERENCES `tbusuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbanalisisriesgo`
--

DROP TABLE IF EXISTS `tbanalisisriesgo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbanalisisriesgo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdRiesgo` int(11) NOT NULL,
  `Probabilidad` int(11) NOT NULL,
  `Impacto` int(11) NOT NULL,
  `NivelRiesgo` int(11) NOT NULL,
  `MedidaControl` varchar(300) NOT NULL,
  `CalificacionMedida` int(11) NOT NULL,
  PRIMARY KEY (`Id`,`IdRiesgo`,`Probabilidad`,`Impacto`,`CalificacionMedida`),
  KEY `fk_tbAnalisisRiesgo_tbParametro1_idx` (`Probabilidad`),
  KEY `fk_tbAnalisisRiesgo_tbParametro2_idx` (`Impacto`),
  KEY `fk_tbAnalisisRiesgo_tbRiesgo1_idx` (`IdRiesgo`),
  KEY `fk_tbAnalisisRiesgo_tbParametro3_idx` (`CalificacionMedida`),
  CONSTRAINT `fk_tbAnalisisRiesgo_tbParametro1` FOREIGN KEY (`Probabilidad`) REFERENCES `tbparametro` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbAnalisisRiesgo_tbParametro2` FOREIGN KEY (`Impacto`) REFERENCES `tbparametro` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbAnalisisRiesgo_tbParametro3` FOREIGN KEY (`CalificacionMedida`) REFERENCES `tbparametro` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbAnalisisRiesgo_tbRiesgo1` FOREIGN KEY (`IdRiesgo`) REFERENCES `tbriesgo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbcategoria`
--

DROP TABLE IF EXISTS `tbcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcategoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `HijoDe` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbdepartamento`
--

DROP TABLE IF EXISTS `tbdepartamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdepartamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(45) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `FechaCreacion` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbdepartamentousuario`
--

DROP TABLE IF EXISTS `tbdepartamentousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdepartamentousuario` (
  `IdDepartamento` int(11) NOT NULL,
  `CedulaUsuario` varchar(15) NOT NULL,
  PRIMARY KEY (`IdDepartamento`,`CedulaUsuario`),
  KEY `fk_tbDepartamentoUsuario_tbUsuario1_idx` (`CedulaUsuario`),
  KEY `fk_tbDepartamentoUsuario_tbDepartamento1_idx` (`IdDepartamento`),
  CONSTRAINT `fk_tbDepartamentoUsuario_tbDepartamento1` FOREIGN KEY (`IdDepartamento`) REFERENCES `tbdepartamento` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbDepartamentoUsuario_tbUsuario1` FOREIGN KEY (`CedulaUsuario`) REFERENCES `tbusuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbparametro`
--

DROP TABLE IF EXISTS `tbparametro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbparametro` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Identificador` int(11) NOT NULL,
  `Valor` int(11) NOT NULL,
  `Descriptor` varchar(45) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbriesgo`
--

DROP TABLE IF EXISTS `tbriesgo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbriesgo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdSevri` int(11) NOT NULL,
  `IdDepartamento` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(3000) NOT NULL,
  `MontoEconomico` double NOT NULL,
  `EstaActivo` tinyint(1) NOT NULL,
  `Causa` varchar(200) NOT NULL,
  `fechaRegistro` date NOT NULL,
  PRIMARY KEY (`Id`,`IdDepartamento`,`IdCategoria`),
  KEY `fk_tbRiesgo_tbDepartamento1_idx` (`IdDepartamento`),
  KEY `fk_tbRiesgo_tb_Categoria1_idx` (`IdCategoria`),
  KEY `IdSevri` (`IdSevri`),
  CONSTRAINT `fk_tbRiesgo_tbDepartamento1` FOREIGN KEY (`IdDepartamento`) REFERENCES `tbdepartamento` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbRiesgo_tb_Categoria1` FOREIGN KEY (`IdCategoria`) REFERENCES `tbcategoria` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbriesgo_ibfk_1` FOREIGN KEY (`IdSevri`) REFERENCES `tbsevri` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbseguimientorisego`
--

DROP TABLE IF EXISTS `tbseguimientorisego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbseguimientorisego` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdAdministracionRiesgo` int(11) NOT NULL,
  `MontoSeguimiento` double NOT NULL,
  `ComentarioAprovador` varchar(1000) DEFAULT NULL,
  `ComentarioAvance` varchar(1000) NOT NULL,
  `PorcentajeAvance` int(11) NOT NULL,
  `FechaAvance` date NOT NULL,
  PRIMARY KEY (`Id`,`IdAdministracionRiesgo`),
  KEY `fk_tbSeguimientoRisego_tbAdministracionRiesgo1_idx` (`IdAdministracionRiesgo`),
  CONSTRAINT `fk_tbSeguimientoRisego_tbAdministracionRiesgo1` FOREIGN KEY (`IdAdministracionRiesgo`) REFERENCES `tbadministracionriesgo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbsevri`
--

DROP TABLE IF EXISTS `tbsevri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsevri` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdAdministrador` varchar(15) NOT NULL,
  `NombreVersion` varchar(100) NOT NULL,
  `FechaCreacion` date NOT NULL,
  `EstaActivo` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`,`IdAdministrador`),
  UNIQUE KEY `NombreVersion` (`NombreVersion`),
  KEY `fk_tbSEVRI_tbUsuario1_idx` (`IdAdministrador`),
  CONSTRAINT `fk_tbSEVRI_tbUsuario1` FOREIGN KEY (`IdAdministrador`) REFERENCES `tbusuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbsevricategoria`
--

DROP TABLE IF EXISTS `tbsevricategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsevricategoria` (
  `IdSEVRI` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  PRIMARY KEY (`IdSEVRI`,`IdCategoria`),
  KEY `fk_tbParametrosSEVRI_tbSEVRI1_idx` (`IdSEVRI`),
  KEY `fk_tbParametrosSEVRI_tb_Categoria1_idx` (`IdCategoria`),
  CONSTRAINT `fk_tbParametrosSEVRI_tbSEVRI1` FOREIGN KEY (`IdSEVRI`) REFERENCES `tbsevri` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbParametrosSEVRI_tb_Categoria1` FOREIGN KEY (`IdCategoria`) REFERENCES `tbcategoria` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbsevridepartamento`
--

DROP TABLE IF EXISTS `tbsevridepartamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsevridepartamento` (
  `IdSEVRI` int(11) NOT NULL,
  `IdDepartamento` int(11) NOT NULL,
  PRIMARY KEY (`IdSEVRI`,`IdDepartamento`),
  KEY `fk_tbRiesgoSEVRI_tbSEVRI1_idx` (`IdSEVRI`),
  KEY `fk_tbSEVRIDepartamento_tbDepartamento1_idx` (`IdDepartamento`),
  CONSTRAINT `fk_tbRiesgoSEVRI_tbSEVRI1` FOREIGN KEY (`IdSEVRI`) REFERENCES `tbsevri` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbSEVRIDepartamento_tbDepartamento1` FOREIGN KEY (`IdDepartamento`) REFERENCES `tbdepartamento` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbsevriparametro`
--

DROP TABLE IF EXISTS `tbsevriparametro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsevriparametro` (
  `IdSEVRI` int(11) NOT NULL,
  `IdParametro` int(11) NOT NULL,
  PRIMARY KEY (`IdSEVRI`,`IdParametro`),
  KEY `fk_tbSEVRIParametro_tbParametro1_idx` (`IdParametro`),
  CONSTRAINT `fk_tbSEVRIParametro_tbParametro1` FOREIGN KEY (`IdParametro`) REFERENCES `tbparametro` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbSEVRIParametro_tbSEVRI1` FOREIGN KEY (`IdSEVRI`) REFERENCES `tbsevri` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbusuario` (
  `Cedula` varchar(15) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `PrimerApellido` varchar(45) NOT NULL,
  `SegundoApellido` varchar(45) NOT NULL,
  `FechaRegistro` date NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Clave` varchar(15) NOT NULL,
  `Cargo` varchar(100) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`Cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'bdsevri'
--

--
-- Dumping routines for database 'bdsevri'
--
/*!50003 DROP PROCEDURE IF EXISTS `actualizarSevri` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarSevri`(IN idSevri INT(11),IN nombre VARCHAR(100),IN fecha DATE)
BEGIN 















UPDATE tbsevri SET NombreVersion=nombre,FechaCreacion=fecha WHERE Id = idSevri;















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarAnalisis` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarAnalisis`(IN pIdAnalisis int(11))
BEGIN 







 DELETE FROM tbanalisisriesgo WHERE id = pIdAnalisis;







END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarDepartamentoAgregado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarDepartamentoAgregado`(IN codigoDepartamento int)
BEGIN
	DECLARE sevri INT DEFAULT 0;

    SELECT Id 
    into sevri 
    from tbsevri
    where EstaActivo = 1;

  DELETE FROM tbsevridepartamento WHERE IdSEVRI = sevri AND IdDepartamento = codigoDepartamento;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarRiesgo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarRiesgo`(































	IN p_idRiesgo int(11)































)
BEGIN































	DELETE FROM tbriesgo































	 WHERE id = p_idRiesgo;































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarSevri` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarSevri`(IN idSevri INT(11))
BEGIN















	DELETE FROM tbsevri WHERE Id = idSevri;















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarSevriCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarSevriCategoria`(IN codigoCategoria INT)
BEGIN

	DECLARE sevri INT DEFAULT 0;

    

    SELECT Id 

    into sevri 

    from tbsevri

    where EstaActivo = 1;

    

	DELETE FROM tbsevricategoria 

    WHERE IdSEVRI = sevri and IdCategoria = codigoCategoria;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarSevriParametros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarSevriParametros`(IN codigoParametro INT)
BEGIN

	DECLARE sevri INT DEFAULT 0;

    

    SELECT Id 

    into sevri 

    from tbsevri

    where EstaActivo = 1;

    

	DELETE FROM tbsevriparametro 

    WHERE IdSEVRI = sevri and IdParametro = codigoParametro;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarAnalisis` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarAnalisis`(







	IN pIdRiesgo int(11),







	IN pIdProbabilidad int(11),







	IN pIdImpacto int(11),







	IN pNivelRiesgo int(11),







	IN pMedidaControl varchar(300),







	IN pCalificacionMedida int(11)







)
BEGIN











		INSERT INTO tbanalisisriesgo



     (







			IdRiesgo,







			Probabilidad,







			Impacto,







			NivelRiesgo,







			MedidaControl,







			CalificacionMedida



)







		VALUES



     (







			pIdRiesgo,







			pIdProbabilidad,







			pIdImpacto,







			pNivelRiesgo,







			pMedidaControl,







			pCalificacionMedida);







	



end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarRiesgo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarRiesgo`(IN `p_idDepartamento` INT(11), IN `p_idCategoria` INT(11), IN `p_nombre` VARCHAR(100), IN `p_descripcion` VARCHAR(3000), IN `p_monto` DOUBLE, IN `p_estado` TINYINT(1), IN `p_causa` VARCHAR(200))
BEGIN































































	DECLARE sevri INT DEFAULT 0;































































    































































    SELECT Id 































































    into sevri 































































    from tbsevri































































    where EstaActivo = 1;































































    































































	INSERT INTO tbriesgo































































    (































































        IdSevri,































































        IdDepartamento,































































		IdCategoria,































































		Nombre,































































		Descripcion,































































		MontoEconomico,































































		EstaActivo,































































		Causa,































































        fechaRegistro































































	)































































	VALUES































































    (































































        sevri,































































		p_idDepartamento,































































		p_idCategoria,































































		p_nombre,































































		p_descripcion,































































		p_monto,































































		p_estado,































































		p_causa,































































        DATE_FORMAT(NOW(),'%Y/%m/%d')































































    );































































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarSevri` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarSevri`(















								IN nombre varchar(100),















                                IN fecha  date















							  )
BEGIN















	Update tbsevri set EstaActivo = 0 where EstaActivo = 1;















	INSERT INTO tbsevri(















						IdAdministrador,















						NombreVersion,















                        FechaCreacion,















                        EstaActivo















						)















	VALUES(















			'123456789',















			nombre,















            fecha,















            1















		  );















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarSevriCategorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarSevriCategorias`(IN codigoCategoria INT)
BEGIN















	DECLARE sevri INT DEFAULT 0;















    















    SELECT Id 















    into sevri 















    from tbsevri















    where EstaActivo = 1;















    















	INSERT INTO tbsevricategoria 















    values(sevri, codigoCategoria);















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarSevriDepartamentos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarSevriDepartamentos`(IN `codigoDepartamento` INT)
BEGIN



	DECLARE sevri INT DEFAULT 0;



    SELECT Id 

    into sevri 

    from tbsevri

    where EstaActivo = 1;



	INSERT INTO tbsevridepartamento 



    values(sevri, codigoDepartamento);





END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarSevriParametros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarSevriParametros`(IN codigoParametro INT)
BEGIN















	DECLARE sevri INT DEFAULT 0;















    















    SELECT Id 















    into sevri 















    from tbsevri















    where EstaActivo = 1;















    















	INSERT INTO tbsevriparametro 















    values(sevri, codigoParametro);















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificarAnalisis` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAnalisis`(

	IN pId int(11),

	IN pProbabilidad int(11),
	IN pImpacto int(11),
	IN pNivelRiesgo int(11),
	IN pMedidaControl varchar(300),
	IN pCalificacionMedida int(11)
	)
BEGIN
		UPDATE tbanalisisriesgo SET Probabilidad = pProbabilidad, Impacto = pImpacto, NivelRiesgo = pNivelRiesgo, MedidaControl = pMedidaControl, CalificacionMedida = pCalificacionMedida WHERE Id = pId;

	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificarRiesgo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarRiesgo`(































	IN p_idRiesgo int(11),































    IN p_idDepartamento int(11),































    IN p_idCategoria int(11),































    IN p_nombre varchar(100),































    IN p_descripcion varchar(3000),































    IN p_monto double,































    IN p_estado tinyint(1),































    IN p_causa varchar(200)































)
BEGIN































	UPDATE tbriesgo 































       SET IdDepartamento=p_idDepartamento, 































           IdCategoria= p_idCategoria, 































           Nombre = p_nombre, 































           Descripcion = p_descripcion,































           MontoEconomico = p_monto,































           EstaActivo = p_estado,































           Causa = p_causa































	 WHERE Id = p_idRiesgo;































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerAnalisis` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerAnalisis`(



	IN pIdAnalisis int(11)



	)
BEGIN



		



		SELECT *



 FROM tbanalisisriesgo where Id = pIdAnalisis;







	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerCategorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerCategorias`(IN `pIdentificador` INT)
BEGIN































































































	SELECT Id,Nombre,Descripcion,HijoDe































      FROM tbcategoria































	 WHERE HijoDe = pIdentificador;































































































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerCategoriasActivas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerCategoriasActivas`()
BEGIN
SELECT DISTINCT T1.Id, T1.Nombre, T1.Descripcion, T1.HijoDe 
	FROM tbcategoria T1 
	INNER JOIN tbsevricategoria T2 
	INNER JOIN tbsevri T3
	WHERE (T1.Id = T2.IdCategoria AND T2.IdSEVRI = t3.Id AND T3.EstaActivo =1) 
	OR 
	(T1.HijoDe = T2.IdCategoria AND T2.IdSEVRI = t3.Id AND T3.EstaActivo =1);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerCategoriasSevriActivo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerCategoriasSevriActivo`()
BEGIN 



	SELECT cat.* FROM tbcategoria cat INNER JOIN

    tbsevricategoria sevCat ON cat.Id = sevCat.IdCategoria INNER JOIN

    tbsevri sev ON sevCat.IdSEVRI = sev.Id WHERE sev.EstaActivo = 1;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerDepartamentos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerDepartamentos`()
BEGIN















































	SELECT *















      FROM tbdepartamento;















































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerDepartamentosAgregados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerDepartamentosAgregados`()
BEGIN
	
    SELECT dep.* FROM tbdepartamento dep
    INNER JOIN tbsevridepartamento sevdev ON dep.Id = sevdev.IdDepartamento
    INNER JOIN tbsevri sev ON sevdev.IdSevri = sev.Id
    WHERE SEV.EstaActivo = 1;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerIdSevriActivo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerIdSevriActivo`()
BEGIN















	SELECT Id from tbsevri WHERE EstaActivo = 1;















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerListaAnalisis` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerListaAnalisis`()
BEGIN







	SELECT DISTINCT 







    analisis.Id,riesgo.Nombre, 







    parametro.Descriptor as Probabilidad, 







    parametro1.Descriptor as Impacto, 







    analisis.NivelRiesgo, analisis.MedidaControl,







    parametro2.Descriptor as CalificacionMedida







    FROM tbanalisisriesgo analisis INNER JOIN tbparametro parametro on analisis.Probabilidad = parametro.Id 







    INNER JOIN tbparametro parametro1 on analisis.Impacto = parametro1.ID 







    INNER JOIN tbparametro parametro2 on analisis.CalificacionMedida = parametro2.ID 







    INNER JOIN tbriesgo riesgo on analisis.IdRiesgo = riesgo.Id 







    INNER JOIN tbsevri sevri on riesgo.IdSevri = sevri.Id WHERE sevri.EstaActivo = 1;







END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerListaSevri` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerListaSevri`()
BEGIN 



SELECT * FROM tbsevri order by FechaCreacion desc;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerParametroPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerParametroPorId`(IN idParametro INT(11))
BEGIN















	SELECT * FROM tbparametro where Id = idParametro;















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerParametros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerParametros`()
BEGIN















































	SELECT *















      FROM tbparametro;















































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerParametrosSevriActivo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerParametrosSevriActivo`()
BEGIN







SELECT parametro.* from tbparametro parametro inner join tbsevriparametro sevripara on parametro.Id = sevripara.IdParametro inner join tbsevri sevri on sevri.Id = sevripara.IdSEVRI where sevri.EstaActivo = 1;







	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerRiesgo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerRiesgo`(































	IN p_idRiesgo int(11)































)
BEGIN































	SELECT *































	  FROM tbriesgo































	 WHERE id = p_idRiesgo;































END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerRiesgoPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerRiesgoPorId`(IN idRiesgo INT(11))
BEGIN















	SELECT * FROM tbriesgo where Id = idRiesgo;















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerRiesgos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerRiesgos`()
BEGIN
SELECT T1.Id, T1.IdSevri, T3.Nombre, T2.Nombre, T1.Nombre, T1.Descripcion, T1.MontoEconomico, T1.EstaActivo, T1.Causa, T1.fechaRegistro 
	FROM tbriesgo T1 
	INNER JOIN tbcategoria T2 
	INNER JOIN tbdepartamento T3
	INNER JOIN tbsevri T4
	WHERE T1.IdCategoria = T2.Id AND T1.IdDepartamento = T3.Id AND T1.IdSevri =T4.Id AND T4.EstaActivo =1
	ORDER BY T1.Nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerRiesgosSevriActivo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerRiesgosSevriActivo`()
BEGIN







	



SELECT riesgo.* from tbriesgo riesgo inner join tbsevri sevri on riesgo.IdSevri = sevri.Id where sevri.EstaActivo = 1;







	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerSevri` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerSevri`(IN idSevri INT(11))
BEGIN 















SELECT * FROM tbsevri WHERE Id = idSevri;















END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtenerTodosAnalisis` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerTodosAnalisis`()
BEGIN
	

SELECT * FROM tbanalisisriesgo;


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

-- Dump completed on 2016-11-16  8:46:57
