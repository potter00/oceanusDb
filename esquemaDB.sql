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

-- Volcando estructura para tabla crud_2019.datosmedicos
CREATE TABLE IF NOT EXISTS `datosmedicos` (
  `IdDatosMedicos` int unsigned NOT NULL AUTO_INCREMENT,
  `idEmpleado` int unsigned NOT NULL DEFAULT '0',
  `Alergias` varchar(150) DEFAULT 'N/A',
  `EnfermedadesCronicas` varchar(150) DEFAULT 'N/A',
  `Lesiones` varchar(150) DEFAULT 'N/A',
  `AlergiasMedicamentos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'N/A',
  `NumeroSeguro` bigint unsigned NOT NULL,
  `NumeroEmergencia` int unsigned NOT NULL DEFAULT '0',
  `TipoSangre` varchar(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdDatosMedicos`),
  UNIQUE KEY `idEmpleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

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
  PRIMARY KEY (`IdDocumentacion`),
  UNIQUE KEY `IdEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Curp` varchar(18) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `Rfc` varchar(13) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `NumeroFijo` varchar(13) COLLATE utf8mb3_spanish_ci DEFAULT '',
  `NumeroCelular` varchar(13) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `Direccion` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `NumeroLicencia` varchar(15) COLLATE utf8mb3_spanish_ci DEFAULT '',
  `NumeroPasaporte` varchar(9) COLLATE utf8mb3_spanish_ci DEFAULT '',
  `FechaIngreso` date DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
