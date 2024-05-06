-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para crud_2019
CREATE DATABASE IF NOT EXISTS `crud_2019` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `crud_2019`;

-- Volcando estructura para tabla crud_2019.cambios
CREATE TABLE IF NOT EXISTS `cambios` (
  `idCambio` smallint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `idUsuario` smallint unsigned DEFAULT NULL,
  `timeStamp` date DEFAULT NULL,
  `tablaCambio` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCambio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.cambios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `idContrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `nombreContrato` varchar(150) DEFAULT '0',
  `idContratante` smallint unsigned DEFAULT '0',
  `idContratado` smallint unsigned DEFAULT '0',
  `subContrato` set('SubContrato','Contrato Origen') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Contrato Origen',
  `idContratoFuente` smallint DEFAULT NULL,
  `numeroContrato` varchar(50) DEFAULT NULL,
  `inicioContrato` date DEFAULT NULL,
  `finContrato` date DEFAULT NULL,
  `idConvenio` smallint unsigned DEFAULT '0',
  `ubicacionContrato` varchar(150) DEFAULT NULL,
  `montoContrato` double DEFAULT NULL,
  `anticipoContrato` double DEFAULT NULL,
  PRIMARY KEY (`idContrato`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.contrato: ~0 rows (aproximadamente)
INSERT INTO `contrato` (`idContrato`, `titulo`, `nombreContrato`, `idContratante`, `idContratado`, `subContrato`, `idContratoFuente`, `numeroContrato`, `inicioContrato`, `finContrato`, `idConvenio`, `ubicacionContrato`, `montoContrato`, `anticipoContrato`) VALUES
	(1, 'purificacion de material', 'purificacion de materias primas para el cumplimiento de  los estandares y normas ISO 2216-1', 3, 38, 'Contrato Origen', 1, '25254', '2024-04-29', '2024-04-29', 1, NULL, 123456, 45623);

-- Volcando estructura para tabla crud_2019.contrato-orden
CREATE TABLE IF NOT EXISTS `contrato-orden` (
  `idRelacionContratoFianza` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idOrden` smallint unsigned DEFAULT NULL,
  `idFianza` smallint DEFAULT NULL,
  PRIMARY KEY (`idRelacionContratoFianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.contrato-orden: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.contrato_fianza
CREATE TABLE IF NOT EXISTS `contrato_fianza` (
  `idRelacionContratoFianza` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idFianza` smallint unsigned DEFAULT NULL,
  `idContrato` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idRelacionContratoFianza`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.contrato_fianza: ~0 rows (aproximadamente)
INSERT INTO `contrato_fianza` (`idRelacionContratoFianza`, `idFianza`, `idContrato`) VALUES
	(1, 1, 1);

-- Volcando estructura para tabla crud_2019.convenio
CREATE TABLE IF NOT EXISTS `convenio` (
  `idMovimiento` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fechaInicio` date DEFAULT NULL,
  `fechaFinal` date DEFAULT NULL,
  `montoAdicional` double DEFAULT '0',
  `idFinanza` smallint DEFAULT NULL,
  `documento` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idMovimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.convenio: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.convenio-contrato
CREATE TABLE IF NOT EXISTS `convenio-contrato` (
  `convenio-contrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idContrato` smallint unsigned NOT NULL DEFAULT '0',
  `idConvenio` smallint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`convenio-contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.convenio-contrato: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.datosmedicos
CREATE TABLE IF NOT EXISTS `datosmedicos` (
  `IdDatosMedicos` int unsigned NOT NULL AUTO_INCREMENT,
  `idEmpleado` int unsigned NOT NULL DEFAULT '0',
  `Alergias` varchar(150) DEFAULT 'N/A',
  `EnfermedadesCronicas` varchar(150) DEFAULT 'N/A',
  `Lesiones` varchar(150) DEFAULT 'N/A',
  `AlergiasMedicamentos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'N/A',
  `NumeroSeguro` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `NumeroEmergencia` varchar(50) NOT NULL DEFAULT '0',
  `TipoSangre` varchar(5) NOT NULL DEFAULT '0',
  `NombreEmergencia` varchar(50) DEFAULT NULL,
  `Genero` set('masculino','femenino','otro') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `RelacionEmergencia` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdDatosMedicos`),
  UNIQUE KEY `idEmpleado` (`idEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.datosmedicos: ~27 rows (aproximadamente)
INSERT INTO `datosmedicos` (`IdDatosMedicos`, `idEmpleado`, `Alergias`, `EnfermedadesCronicas`, `Lesiones`, `AlergiasMedicamentos`, `NumeroSeguro`, `NumeroEmergencia`, `TipoSangre`, `NombreEmergencia`, `Genero`, `RelacionEmergencia`) VALUES
	(16, 30, 'NA', 'NA', 'NA', 'NA', '12345678912', '6221508692', 'O-', 'Pablo', 'femenino', 'Madre'),
	(17, 31, 'NA', 'Soplo cardiaco', 'NA', 'NA', '36160112637', '6221312127', 'O+', 'Milagros Ruiz Flores', 'masculino', 'Madre'),
	(32, 32, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24018357137', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(34, 37, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24129273413', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(38, 38, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '88169532368', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(40, 39, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '21926602844', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(41, 40, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '07139624535', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(42, 41, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24028804607', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(43, 42, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24078531191', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(44, 43, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24008298101', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(55, 52, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '01139874091', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(56, 53, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24078531191', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(57, 54, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '88169532368', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(58, 55, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24028804607', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(59, 56, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '21926602844', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(62, 57, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '01139874091', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(63, 58, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24078531191', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(64, 59, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '88169532368', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(65, 60, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24028804607', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(66, 61, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '21926602844', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(75, 62, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '04139996542', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(76, 63, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '27169964940', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(77, 64, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '01139874091', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(78, 65, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24078531191', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(79, 66, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '88169532368', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(80, 67, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '24028804607', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(81, 68, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '21926602844', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(82, 69, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '04139996542', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion'),
	(83, 70, 'Sin Alergias', 'Sin enfermedades cronicas', 'Sin lesiones', 'Sin alergias a medicamentos', '27169964940', '0000000000', 'NA', 'Sin Nombre', 'otro', 'Sin Relacion');

-- Volcando estructura para tabla crud_2019.documentacion
CREATE TABLE IF NOT EXISTS `documentacion` (
  `IdDocumentacion` int NOT NULL AUTO_INCREMENT,
  `IdEmpleado` int NOT NULL DEFAULT '0',
  `Credencial` varchar(150) NOT NULL,
  `Licencia` varchar(150) NOT NULL,
  `Pasaporte` varchar(150) NOT NULL,
  `CV` varchar(150) NOT NULL,
  `Curp` varchar(150) NOT NULL,
  `Inss` varchar(150) NOT NULL,
  `ConstanciaSat` varchar(150) NOT NULL,
  `Foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ActaNacimiento` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'sin cambio',
  `EstadoCuentaBanco` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'sin cambio',
  `AltaSeguroSocial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'sin cambio',
  `CedulaProfecional` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'sin cambio',
  `CopiaContrato` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'sin cambio',
  `ComprobanteDomicilio` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'sin cambio',
  PRIMARY KEY (`IdDocumentacion`),
  UNIQUE KEY `IdEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.documentacion: ~26 rows (aproximadamente)
INSERT INTO `documentacion` (`IdDocumentacion`, `IdEmpleado`, `Credencial`, `Licencia`, `Pasaporte`, `CV`, `Curp`, `Inss`, `ConstanciaSat`, `Foto`, `ActaNacimiento`, `EstadoCuentaBanco`, `AltaSeguroSocial`, `CedulaProfecional`, `CopiaContrato`, `ComprobanteDomicilio`) VALUES
	(7, 30, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'archivos/30/30_Ana Maria quinta_Foto.jpeg', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(8, 31, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'archivos/31/31_Urias Ruiz Omar Ignacio_Curp.pdf', 'sin cambio', 'sin cambio', 'sin cambio', 'archivos/31/31_Urias Ruiz Omar Ignacio_ActaNacimiento.pdf', 'archivos/31/31_Urias Ruiz Omar Ignacio_EstadoCuentaBanco.pdf', 'archivos/31/31_Urias Ruiz Omar Ignacio_AltaSeguroSocial.pdf', 'archivos/31/31_Urias Ruiz Omar Ignacio_CedulaProfecional.pdf', 'archivos/31/31_Urias Ruiz Omar Ignacio_CopiaContrato.pdf', 'archivos/31/31_Urias Ruiz Omar Ignacio_ComprobanteDomicilio.pdf'),
	(23, 32, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(24, 37, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(29, 38, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(31, 39, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(32, 41, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(33, 40, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(34, 42, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(35, 43, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(46, 52, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(47, 53, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(48, 54, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(49, 55, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(50, 56, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(53, 57, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(54, 58, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(55, 59, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(56, 60, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(57, 61, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(66, 62, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(67, 63, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(68, 64, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(69, 65, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(70, 66, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(71, 67, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(72, 68, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(73, 69, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio'),
	(74, 70, 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio', 'sin cambio');

-- Volcando estructura para tabla crud_2019.documentossubcontratados
CREATE TABLE IF NOT EXISTS `documentossubcontratados` (
  `idDocumentosSubcontratados` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idSubContratado` smallint unsigned DEFAULT NULL,
  `rfc` varchar(150) DEFAULT NULL,
  `inss` varchar(150) DEFAULT NULL,
  `ine` varchar(150) DEFAULT NULL,
  `curp` varchar(150) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idDocumentosSubcontratados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.documentossubcontratados: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` smallint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(150) DEFAULT '0',
  `rfc` varchar(50) DEFAULT '0',
  `razonSocial` varchar(150) DEFAULT '0',
  `representanteLegal` varchar(50) DEFAULT '0',
  `nombreContacto` varchar(50) DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefono` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `correoFacturacion` varchar(50) DEFAULT NULL,
  `numeroCuenta` varchar(50) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `tipoRegimen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `constanciaFiscal` varchar(50) DEFAULT NULL,
  `fechaVencimientoConstancia` date DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.empresa: ~4 rows (aproximadamente)
INSERT INTO `empresa` (`idEmpresa`, `logo`, `rfc`, `razonSocial`, `representanteLegal`, `nombreContacto`, `correo`, `telefono`, `correoFacturacion`, `numeroCuenta`, `banco`, `tipoRegimen`, `constanciaFiscal`, `fechaVencimientoConstancia`) VALUES
	(1, 'logo', 'njgsdbnagsda456', 'dedicacion a la naturaleza y ambiente CA de CV', 'petter', 'Parker 2', 'correo@gmail.com', '6221508696', 'facturaAqui', '156465132', 'BBVA', 'Regimen1', NULL, '2024-06-25'),
	(2, 'logo', 'sfgsdfASFZ', 'constructora SA de CV', 'Perez Castro', 'diego facturas', 'correo@gmail.com', '622515628', 'facturaAqui@gmail.com', '123456789', 'Banorte', 'regimen constructor', NULL, '2024-06-30'),
	(3, 'logo', 'gnksdhbnglkjsdbn', 'Purificadora SA de CV', 'Carlos Carlos', NULL, 'correo@gmail.com', '622515628', NULL, NULL, NULL, 'regimen 3', NULL, '2024-05-28'),
	(34, 'sin logo', 'asgdswqeq', 'fabricadora SA de CV', 'petter', 'petter', 'parker@gmail.com', '85165165156', 'faturacion321@gmail.com', '4564816', 'BanCoppel', 'construccion de utiles', NULL, '2024-06-20'),
	(38, 'sin definir', 'sin definir', 'Oceanus Supervisión y Proyectos SA de CV', 'sin definir', '', 'sin definir', 'sin definir', '', '', '', 'sin definir', NULL, '2024-11-15');

-- Volcando estructura para tabla crud_2019.empresa-personal
CREATE TABLE IF NOT EXISTS `empresa-personal` (
  `idRelacion` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` smallint unsigned DEFAULT NULL,
  `idEmpresa` smallint unsigned DEFAULT NULL,
  `terceros` set('true','false') DEFAULT NULL,
  PRIMARY KEY (`idRelacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.empresa-personal: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idContrato` smallint unsigned NOT NULL DEFAULT '0',
  `titulo` varchar(50) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `documento` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idFactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.factura: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.familiares
CREATE TABLE IF NOT EXISTS `familiares` (
  `IdFamiliar` int NOT NULL AUTO_INCREMENT,
  `IdEmpleado` int NOT NULL,
  `TipoParentesco` enum('hijo','pareja','madre','padre','abuelo','abuela','otro') NOT NULL,
  `Nombre completo` varchar(80) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  PRIMARY KEY (`IdFamiliar`),
  UNIQUE KEY `idEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.familiares: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.fianzas
CREATE TABLE IF NOT EXISTS `fianzas` (
  `idFianzas` smallint unsigned NOT NULL AUTO_INCREMENT,
  `documento` varchar(150) DEFAULT NULL,
  `tipoDeCambio` set('dolar','peso') DEFAULT NULL,
  `fianzaCumplimiento` smallint unsigned DEFAULT NULL,
  `fianzaAnticipo` smallint unsigned DEFAULT NULL,
  `FianzaViciosOcultos` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idFianzas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianzas: ~0 rows (aproximadamente)
INSERT INTO `fianzas` (`idFianzas`, `documento`, `tipoDeCambio`, `fianzaCumplimiento`, `fianzaAnticipo`, `FianzaViciosOcultos`) VALUES
	(1, 'ruta documento', 'peso', 1, 1, 1);

-- Volcando estructura para tabla crud_2019.fianza_anticipo
CREATE TABLE IF NOT EXISTS `fianza_anticipo` (
  `idFianzaAnticipo` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaAnticipoDoc` varchar(150) DEFAULT NULL,
  `fianzaAnticipoInicio` date DEFAULT NULL,
  `fianzaAnticipoFin` date DEFAULT NULL,
  `fianzaAnticipoPoliza` varchar(50) DEFAULT NULL,
  `fianzaAnticipoAseguradora` varchar(50) DEFAULT NULL,
  `fianzaAnticipoMonto` double DEFAULT NULL,
  PRIMARY KEY (`idFianzaAnticipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianza_anticipo: ~1 rows (aproximadamente)
INSERT INTO `fianza_anticipo` (`idFianzaAnticipo`, `fianzaAnticipoDoc`, `fianzaAnticipoInicio`, `fianzaAnticipoFin`, `fianzaAnticipoPoliza`, `fianzaAnticipoAseguradora`, `fianzaAnticipoMonto`) VALUES
	(1, 'ruta documento', '2024-04-16', '2024-04-16', '8+651651', 'aseguradora 1', 165454);

-- Volcando estructura para tabla crud_2019.fianza_cumplimiento
CREATE TABLE IF NOT EXISTS `fianza_cumplimiento` (
  `idFianzaCumplimiento` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaCumplimientoDoc` varchar(150) DEFAULT NULL,
  `fianzaCumplimientoInicio` date DEFAULT NULL,
  `fianzaCumplimientoFin` date DEFAULT NULL,
  `fianzaCumplimientoPoliza` varchar(50) DEFAULT NULL,
  `fianzaCumplimientoAseguradora` varchar(150) DEFAULT NULL,
  `fianzaCumplimientoMonto` double DEFAULT NULL,
  PRIMARY KEY (`idFianzaCumplimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianza_cumplimiento: ~1 rows (aproximadamente)
INSERT INTO `fianza_cumplimiento` (`idFianzaCumplimiento`, `fianzaCumplimientoDoc`, `fianzaCumplimientoInicio`, `fianzaCumplimientoFin`, `fianzaCumplimientoPoliza`, `fianzaCumplimientoAseguradora`, `fianzaCumplimientoMonto`) VALUES
	(1, 'ruta de guardado', '2024-10-10', '2024-04-16', '00000', 'aseguradora 1', 4516525);

-- Volcando estructura para tabla crud_2019.fianza_vicios_ocultos
CREATE TABLE IF NOT EXISTS `fianza_vicios_ocultos` (
  `idFianzaViciosOcultos` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaViciosOcultosDoc` varchar(150) DEFAULT NULL,
  `fianzaViciosOcultosInicio` date DEFAULT NULL,
  `fianzaViciosOcultosFin` date DEFAULT NULL,
  `fianzaViciosOcultosPoliza` varchar(150) DEFAULT NULL,
  `fianzaViciosOcultosAseguradora` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fianzaViciosOcultosMonto` double DEFAULT NULL,
  PRIMARY KEY (`idFianzaViciosOcultos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianza_vicios_ocultos: ~1 rows (aproximadamente)
INSERT INTO `fianza_vicios_ocultos` (`idFianzaViciosOcultos`, `fianzaViciosOcultosDoc`, `fianzaViciosOcultosInicio`, `fianzaViciosOcultosFin`, `fianzaViciosOcultosPoliza`, `fianzaViciosOcultosAseguradora`, `fianzaViciosOcultosMonto`) VALUES
	(1, 'ruta doc', '2024-04-16', '2024-04-16', '5465189', 'aseguradora 1', 156516);

-- Volcando estructura para tabla crud_2019.formacademica
CREATE TABLE IF NOT EXISTS `formacademica` (
  `IdDatosAcademicos` int NOT NULL AUTO_INCREMENT,
  `IdEmpleado` int NOT NULL,
  `Cedula` varchar(50) NOT NULL DEFAULT '0',
  `Carrera` varchar(50) NOT NULL,
  `ExpLaboral` text,
  `Certificaciones` text,
  `GradoEstudios` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdDatosAcademicos`) USING BTREE,
  UNIQUE KEY `IdEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.formacademica: ~27 rows (aproximadamente)
INSERT INTO `formacademica` (`IdDatosAcademicos`, `IdEmpleado`, `Cedula`, `Carrera`, `ExpLaboral`, `Certificaciones`, `GradoEstudios`) VALUES
	(1, 31, '1234567', 'Software', 'NA', 'NA', 'Estudiante'),
	(2, 30, '1234567', 'software', 'NA', 'NA', 'ingenieria'),
	(32, 32, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(33, 37, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(38, 38, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(40, 39, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(41, 40, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(42, 41, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(43, 42, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(44, 43, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(55, 52, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(56, 53, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(57, 54, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(58, 55, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(59, 56, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(62, 57, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(63, 58, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(64, 59, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(65, 60, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(66, 61, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(75, 62, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(76, 63, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(77, 64, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(78, 65, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(79, 66, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(80, 67, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(81, 68, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(82, 69, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios'),
	(83, 70, '0000000', 'Sin Carrera', 'Sin Experiencia Laboral', 'Sin Certificaciones', 'Sin Grado de Estudios');

-- Volcando estructura para tabla crud_2019.notificaciones
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idNotificacion` smallint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `fecha` date DEFAULT NULL,
  `vinculoRelacionado` varchar(150) DEFAULT NULL,
  `estado` set('activo','inactivo') DEFAULT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `idTabla` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idNotificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.notificaciones: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.ordenservicio
CREATE TABLE IF NOT EXISTS `ordenservicio` (
  `idOrden` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idContratante` smallint unsigned DEFAULT NULL,
  `idContratado` smallint unsigned DEFAULT NULL,
  `numeroOrden` varchar(50) DEFAULT NULL,
  `inicioOrden` date DEFAULT NULL,
  `finOrden` date DEFAULT NULL,
  `ubicacionOrden` varchar(150) DEFAULT NULL,
  `montoOrden` double DEFAULT NULL,
  `anticipo` double DEFAULT NULL,
  `idContratoFuente` smallint DEFAULT NULL,
  `convenio` smallint DEFAULT NULL,
  PRIMARY KEY (`idOrden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.ordenservicio: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.personal-contrato
CREATE TABLE IF NOT EXISTS `personal-contrato` (
  `idRelacionContrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` smallint DEFAULT NULL,
  `idContrato` smallint DEFAULT NULL,
  `terceros` set('true','false') DEFAULT 'false',
  PRIMARY KEY (`idRelacionContrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.personal-contrato: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Curp` varchar(18) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `Rfc` varchar(13) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `NumeroFijo` varchar(13) COLLATE utf8mb3_spanish_ci DEFAULT '',
  `NumeroCelular` varchar(13) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `Direccion` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `NumeroLicencia` varchar(15) COLLATE utf8mb3_spanish_ci DEFAULT '',
  `NumeroPasaporte` varchar(9) COLLATE utf8mb3_spanish_ci DEFAULT '',
  `FechaIngreso` date DEFAULT NULL,
  `Estado` set('activo','inactivo') COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `TipoContrato` set('indefinido','temporal','obra') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `InicioContrato` date DEFAULT NULL,
  `FinContrato` date DEFAULT NULL,
  `Correo` varchar(50) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `INE` varchar(20) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `estadoCivil` set('soltero','casado') COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla crud_2019.personas: ~31 rows (aproximadamente)
INSERT INTO `personas` (`Id`, `Nombre`, `FechaNacimiento`, `Curp`, `Rfc`, `NumeroFijo`, `NumeroCelular`, `Direccion`, `NumeroLicencia`, `NumeroPasaporte`, `FechaIngreso`, `Estado`, `TipoContrato`, `InicioContrato`, `FinContrato`, `Correo`, `INE`, `estadoCivil`) VALUES
	(30, 'Ana Maria quinta', '2001-11-25', '123456789123456789', '1234567891234', 'NA', '6221508692', 'tulipanes numero 114 colonia el alamo', 'NA', 'NA', '2018-05-25', 'activo', 'temporal', '2024-03-28', '2024-03-09', 'Ana_Maria_quinta@gmail.com', '000000', 'soltero'),
	(31, 'Urias Ruiz Omar Ignacio', '2001-11-14', 'UIRO011114HSRRZMA4', '1234567891234', 'NA', '6221508692', 'Calle tulipanes numero 114, colonia el alamo', 'NA', 'NA', '2024-01-29', 'activo', 'indefinido', '2024-01-29', '2024-07-29', 'omar.ignacio.uri@gmail.com', '000000000000', 'soltero'),
	(32, 'Analberto Dávalos Gutiérrez', '1000-01-01', 'DAGA840917HNTVTN08', 'DAGA840917TL3', NULL, '6221202102', 'C mar del norte 33 L 15 M 5 fraccionamiento los misioneros 85420 Guaymas, Sonora.', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'a.n.alberto@hotmail.com', '1522064871230', 'casado'),
	(33, 'Eleuterio Aquí ruiz', '1000-01-01', 'AURE650313HSLQZL17', 'AURE650313AQ3', NULL, '6682197328', 'c mar asiático 31 col Luis Donaldo Colosio 85420 Guaymas, Sonora ', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'meauear@gmail.com', '1023063680386', 'casado'),
	(34, 'Francisco Ulises Camacho Sánchez ', '1000-01-01', 'CASF981020HSRMNR00', 'CASF981020PD1', NULL, '6221501296', 'Cjon privado L 10 M 13 Col. Las villas 85440 Guaymas, Sonora.', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'ulisescs098@gmail.com ', '1044119037554', 'soltero'),
	(35, 'Juan Carlos Méndez Pacheco ', '1000-01-01', 'MEPJ920604HSRNCN02', 'MEPJ920604JS5', NULL, '6221630221', 'AV VI L 3 N 149 COL. Miguel Hidalgo 85440 Guaymas, Sonora ', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'juancarlos.mendez92@gmail.com ', '1056086358449', 'casado'),
	(36, 'Luis Alberto Nuñez Boydo', '1000-01-01', 'NUBL850525HSRXYS07', 'NUBL850525BP6', NULL, '6221471109', 'C orense 50 L 2 M 10 Fracc Niza Galiza 85456 Guaymas, Sonora', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'boydo_@hotmail.com', '1022044387633', 'casado'),
	(37, 'Anibal Guadalupe Arreola Lopez', '1000-01-01', 'AELA980525HSRRPN06', 'AELA980525L21', NULL, '6331025457', 'C 8 Va L 9A M 68 Col. Pascual Ortiz Rubio CP 85350', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'lopezlopez.g115@gmail.com', '1001105915056', 'soltero'),
	(38, 'alvaro tapia tamayo', '1000-01-01', 'TATA951027HSRPML06', '0000000000000', NULL, '6221705363', 'C sin nombre L 13 M 139B Col. Ampl independencia 85490 Guaymas, Son.', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'ALVAROTAPIAT@gmail.com ', '1075135668614', 'soltero'),
	(39, 'Roberto godoy', '1000-01-01', 'GOCJ660329HSRDRS03', 'GOCJ660329BR4', NULL, '6621380704', 'RITNO RICARDO YAÑEZ 20 FRACC URBI ALAMEDA LOS ENCINOS II 83293 HERMOSILLO SONORA', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'jrgodoc1@gmail.com', '558038877497', 'casado'),
	(40, 'Jose Luis Dworak', '1000-01-01', '000000000000000000', '0000000000000', NULL, '6221092842', 'Sin Direccion', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'JLDO_13@hotmail.com', '0000000000', 'soltero'),
	(41, 'olga navarro', '1000-01-01', 'NASO880115MSRVLL01', 'NASO880115CD4', NULL, '6221032230', 'Av XIX C 27 310 Col. Centro 85400 Guaymas, Sonora', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'olgaa_navarro15@hotmail.com', '1039075164908', 'casado'),
	(42, 'Oscar Sánchez Gómez', '1000-01-01', 'SAGO851214HSRNMS03', 'SAGO8512148E6', NULL, '6221253693', 'C madre perla 4 Fraccionamiento el dorado 85455 Guaymas, Sonora. ', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'oscarsg14@gmail.com ', '1041066789818', 'soltero'),
	(43, 'Abraham Suzuki Hernández ', '1000-01-01', 'SUHA821004HSRZRB01', 'SUHA8210047VO', NULL, '6221150041', 'AV II C 9 Y 10 476 COL. San Vicente 85465 Guaymas, Sonora. ', NULL, '000000000', '1000-01-01', 'activo', 'temporal', NULL, NULL, 'suzuki.ik4@gmail.com', '1067063837254', 'casado'),
	(52, 'Francisco Ulises Camacho Sánchez ', '1000-01-01', 'CASF981020HSRMNR00', 'CASF981020PD1', '0000000000', '6221501296', 'Cjon privado L 10 M 13 Col. Las villas 85440 Guaymas, Sonora.', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'ulisescs098@gmail.com ', '1044119037554', 'soltero'),
	(53, 'Oscar Sánchez Gómez', '1000-01-01', 'SAGO851214HSRNMS03', 'SAGO8512148E6', '0000000000', '6221253693', 'C madre perla 4 Fraccionamiento el dorado 85455 Guaymas, Sonora. ', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'oscarsg14@gmail.com ', '1041066789818', 'soltero'),
	(54, 'alvaro tapia tamayo', '1000-01-01', 'TATA951027HSRPML06', '0000000000000', '0000000000', '6221705363', 'C sin nombre L 13 M 139B Col. Ampl independencia 85490 Guaymas, Son.', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'ALVAROTAPIAT@gmail.com ', '1075135668614', 'soltero'),
	(55, 'olga navarro', '1000-01-01', 'NASO880115MSRVLL01', 'NASO880115CD4', '0000000000', '6221032230', 'Av XIX C 27 310 Col. Centro 85400 Guaymas, Sonora', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'olgaa_navarro15@hotmail.com', '1039075164908', 'casado'),
	(56, 'Roberto godoy', '1000-01-01', 'GOCJ660329HSRDRS03', 'GOCJ660329BR4', '0000000000', '6621380704', 'RITNO RICARDO YAÑEZ 20 FRACC URBI ALAMEDA LOS ENCINOS II 83293 HERMOSILLO SONORA', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'jrgodoc1@gmail.com', '558038877497', 'casado'),
	(57, 'Francisco Ulises Camacho Sánchez ', '1000-01-01', 'CASF981020HSRMNR00', 'CASF981020PD1', '0000000000', '6221501296', 'Cjon privado L 10 M 13 Col. Las villas 85440 Guaymas, Sonora.', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'ulisescs098@gmail.com ', '1044119037554', 'soltero'),
	(58, 'Oscar Sánchez Gómez', '1000-01-01', 'SAGO851214HSRNMS03', 'SAGO8512148E6', '0000000000', '6221253693', 'C madre perla 4 Fraccionamiento el dorado 85455 Guaymas, Sonora. ', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'oscarsg14@gmail.com ', '1041066789818', 'soltero'),
	(59, 'alvaro tapia tamayo', '1000-01-01', 'TATA951027HSRPML06', '0000000000000', '0000000000', '6221705363', 'C sin nombre L 13 M 139B Col. Ampl independencia 85490 Guaymas, Son.', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'ALVAROTAPIAT@gmail.com ', '1075135668614', 'soltero'),
	(60, 'olga navarro', '1000-01-01', 'NASO880115MSRVLL01', 'NASO880115CD4', '0000000000', '6221032230', 'Av XIX C 27 310 Col. Centro 85400 Guaymas, Sonora', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'olgaa_navarro15@hotmail.com', '1039075164908', 'casado'),
	(61, 'Roberto godoy', '1000-01-01', 'GOCJ660329HSRDRS03', 'GOCJ660329BR4', '0000000000', '6621380704', 'RITNO RICARDO YAÑEZ 20 FRACC URBI ALAMEDA LOS ENCINOS II 83293 HERMOSILLO SONORA', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'jrgodoc1@gmail.com', '558038877497', 'casado'),
	(62, 'Aranza Rodriguez', '1000-01-01', 'IARA990530MSRBDR02', 'IARA990530TL8', '0000000000', '6221092842', 'C NICOLAS BRAVO 211 COL MODERNA 85330 EMPALME, SONORA', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'aranzagisellrdgz@gmail.com', '1007118195987', 'soltero'),
	(63, 'Jazmin ', '1000-01-01', 'GUMJ990216MSRZYZ04', 'GUMJ990216CG2', '0000000000', '6221705255', 'PRIV MOCTEZUMA 158 L 5 M 11 COL EL CENTINELA 85499', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'guzmanjazminlcm@gmail.com', '1081117741332', 'soltero'),
	(64, 'Francisco Ulises Camacho Sánchez ', '1000-01-01', 'CASF981020HSRMNR00', 'CASF981020PD1', '0000000000', '6221501296', 'Cjon privado L 10 M 13 Col. Las villas 85440 Guaymas, Sonora.', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'ulisescs098@gmail.com ', '1044119037554', 'soltero'),
	(65, 'Oscar Sánchez Gómez', '1000-01-01', 'SAGO851214HSRNMS03', 'SAGO8512148E6', '0000000000', '6221253693', 'C madre perla 4 Fraccionamiento el dorado 85455 Guaymas, Sonora. ', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'oscarsg14@gmail.com ', '1041066789818', 'soltero'),
	(66, 'alvaro tapia tamayo', '1000-01-01', 'TATA951027HSRPML06', '0000000000000', '0000000000', '6221705363', 'C sin nombre L 13 M 139B Col. Ampl independencia 85490 Guaymas, Son.', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'ALVAROTAPIAT@gmail.com ', '1075135668614', 'soltero'),
	(67, 'olga navarro', '1000-01-01', 'NASO880115MSRVLL01', 'NASO880115CD4', '0000000000', '6221032230', 'Av XIX C 27 310 Col. Centro 85400 Guaymas, Sonora', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'olgaa_navarro15@hotmail.com', '1039075164908', 'casado'),
	(68, 'Roberto godoy', '1000-01-01', 'GOCJ660329HSRDRS03', 'GOCJ660329BR4', '0000000000', '6621380704', 'RITNO RICARDO YAÑEZ 20 FRACC URBI ALAMEDA LOS ENCINOS II 83293 HERMOSILLO SONORA', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'jrgodoc1@gmail.com', '558038877497', 'casado'),
	(69, 'Aranza Rodriguez', '1000-01-01', 'IARA990530MSRBDR02', 'IARA990530TL8', '0000000000', '6221092842', 'C NICOLAS BRAVO 211 COL MODERNA 85330 EMPALME, SONORA', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'aranzagisellrdgz@gmail.com', '1007118195987', 'soltero'),
	(70, 'Jazmin ', '1000-01-01', 'GUMJ990216MSRZYZ04', 'GUMJ990216CG2', '0000000000', '6221705255', 'PRIV MOCTEZUMA 158 L 5 M 11 COL EL CENTINELA 85499', '000000000000000', '000000000', '1000-01-01', 'activo', 'temporal', '1000-01-01', '1000-01-01', 'guzmanjazminlcm@gmail.com', '1081117741332', 'soltero');

-- Volcando estructura para tabla crud_2019.subcontratados
CREATE TABLE IF NOT EXISTS `subcontratados` (
  `idSubContratado` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  `inss` varchar(50) DEFAULT NULL,
  `ine` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `estado` set('activo','inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idSubContratado`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.subcontratados: ~5 rows (aproximadamente)
INSERT INTO `subcontratados` (`idSubContratado`, `nombre`, `rfc`, `inss`, `ine`, `curp`, `estado`) VALUES
	(1, 'Juan carlo bodoque', 'asfas', '12235152', '55213151354', 'dasdfas5551asfas', 'activo'),
	(2, 'paquito', 'asgsagsa', '554555', '46525255', 'asfgasg55ad4g65s', 'activo'),
	(3, 'joaquin', 'asfasd456a1s5f', '53116516', '156165', 'asfasf561', 'activo'),
	(11, 'pedro miguel', 'refc123asdwaa', '152361352', '125135234', 'afsafeqw3123', 'activo');

-- Volcando estructura para tabla crud_2019.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '856fc81623da2150ba2210ba1b51d241',
  `type` set('admin','user') COLLATE utf8mb3_spanish_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla crud_2019.usuarios: ~8 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `usuario`, `password`, `type`) VALUES
	(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
	(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'user'),
	(3, 'omar@oceanus.mx', '856fc81623da2150ba2210ba1b51d241', 'admin'),
	(4, 'olga@oceanus.mx', '856fc81623da2150ba2210ba1b51d241', 'admin'),
	(5, 'lulu@oceanus.mx', '856fc81623da2150ba2210ba1b51d241', 'admin'),
	(6, 'luis@oceanus.mx', '856fc81623da2150ba2210ba1b51d241', 'admin'),
	(7, 'juan@oceanus.mx', '856fc81623da2150ba2210ba1b51d241', 'user'),
	(8, 'suzuki@oceanus.mx', '856fc81623da2150ba2210ba1b51d241', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
