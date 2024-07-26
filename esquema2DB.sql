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
  `ifContrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `nombreContrato` varchar(150) DEFAULT '0',
  `idContratante` smallint unsigned DEFAULT '0',
  `idContratado` smallint unsigned DEFAULT '0',
  `subContrato` set('true','false') DEFAULT 'false',
  `idContratoFuente` smallint DEFAULT NULL,
  `numeroContrato` smallint unsigned DEFAULT NULL,
  `inicioContrato` date DEFAULT NULL,
  `finContrato` date DEFAULT NULL,
  `idConvenio` smallint unsigned DEFAULT '0',
  `ubicacionContrato` varchar(150) DEFAULT NULL,
  `montoContrato` double DEFAULT NULL,
  `anticipoContrato` double DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`ifContrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.contrato: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.contrato-fianza
CREATE TABLE IF NOT EXISTS `contrato-fianza` (
  `idRelacionContratoFianza` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idFianza` smallint unsigned DEFAULT NULL,
  `idContrato` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idRelacionContratoFianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.contrato-fianza: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.contrato-orden
CREATE TABLE IF NOT EXISTS `contrato-orden` (
  `idRelacionContratoFianza` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idOrden` smallint unsigned DEFAULT NULL,
  `idFianza` smallint DEFAULT NULL,
  PRIMARY KEY (`idRelacionContratoFianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.contrato-orden: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.datosmedicos: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.documentacion: ~0 rows (aproximadamente)

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
  `correo` varchar(50) DEFAULT '0',
  `telefono` varchar(50) DEFAULT '0',
  `tipoRegimen` varchar(50) DEFAULT '0',
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.empresa: ~3 rows (aproximadamente)
INSERT IGNORE INTO `empresa` (`idEmpresa`, `logo`, `rfc`, `razonSocial`, `representanteLegal`, `correo`, `telefono`, `tipoRegimen`) VALUES
	(1, '"ruta logo"', 'njgsdbnagsda456', 'dedicacion a la naturaleza y ambiente CA de CV', 'Martin Perez', 'correo@gmail.com', '6221508696', 'Regimen1'),
	(2, 'sin logo', 'agf nasbfk.s', 'Contrucciones SA de CV', 'Peres Castro', 'correo@gmail.com', '6221508692', 'regimen 2'),
	(3, 'logo', 'gnksdhbnglkjsdbn', 'Purificadora SA de CV', 'Carlos Carlos', 'correo@gmail.com', '622515628', 'regimen 3');

-- Volcando estructura para tabla crud_2019.empresa-personal
CREATE TABLE IF NOT EXISTS `empresa-personal` (
  `idRelacion` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` smallint unsigned DEFAULT NULL,
  `idEmpresa` smallint unsigned DEFAULT NULL,
  `terceros` set('true','false') DEFAULT NULL,
  PRIMARY KEY (`idRelacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.empresa-personal: ~0 rows (aproximadamente)

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

-- Volcando estructura para tabla crud_2019.fianzaanticipo
CREATE TABLE IF NOT EXISTS `fianzaanticipo` (
  `idFianzaAnticipo` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaAnticipoInicio` date DEFAULT NULL,
  `fianzaAnticipoFin` date DEFAULT NULL,
  `fianzaAnticipoPoliza` varchar(50) DEFAULT NULL,
  `fianzaAnticipoAseguradora` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idFianzaAnticipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianzaanticipo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.fianzacumplimiento
CREATE TABLE IF NOT EXISTS `fianzacumplimiento` (
  `idFianzaCumplimiento` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaCumplimientoDoc` varchar(150) DEFAULT NULL,
  `fianzaCumplimientoInicio` varchar(150) DEFAULT NULL,
  `fianzaCumplimientoFin` date DEFAULT NULL,
  `fianzaCumplimientoPoliza` date DEFAULT NULL,
  `fianzaCumplimientoAseguradora` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idFianzaCumplimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianzacumplimiento: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.fianzas
CREATE TABLE IF NOT EXISTS `fianzas` (
  `idFianzas` smallint unsigned NOT NULL AUTO_INCREMENT,
  `documento` varchar(150) DEFAULT NULL,
  `tipoDeCambio` set('dolar','peso') DEFAULT NULL,
  `fianzaCumplimiento` smallint unsigned DEFAULT NULL,
  `fianzaAnticipo` smallint unsigned DEFAULT NULL,
  `FianzaViciosOcultos` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idFianzas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianzas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.fianzaviciosocultos
CREATE TABLE IF NOT EXISTS `fianzaviciosocultos` (
  `idFianzaViciosOcultos` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaViciosOcultosDoc` varchar(150) DEFAULT NULL,
  `fianzaViciosOcultosInicio` date DEFAULT NULL,
  `fianzaViciosOcultosFin` date DEFAULT NULL,
  `fianzaViciosOcultosPoliza` varchar(150) DEFAULT NULL,
  `fianzaViciosOcultosAsegurado` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idFianzaViciosOcultos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.fianzaviciosocultos: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.formacademica: ~0 rows (aproximadamente)

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
  `Curp` varchar(18) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `Rfc` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `NumeroFijo` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT '',
  `NumeroCelular` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `Direccion` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `NumeroLicencia` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT '',
  `NumeroPasaporte` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT '',
  `FechaIngreso` date DEFAULT NULL,
  `Estado` set('activo','inactivo') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `TipoContrato` set('indefinido','temporal','obra') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `InicioContrato` date DEFAULT NULL,
  `FinContrato` date DEFAULT NULL,
  `Correo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `INE` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `estadoCivil` set('soltero','casado') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla crud_2019.personas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.subcontratados
CREATE TABLE IF NOT EXISTS `subcontratados` (
  `idSubContratado` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  `inss` varchar(50) DEFAULT NULL,
  `ine` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `estado` set('true','false') DEFAULT NULL,
  PRIMARY KEY (`idSubContratado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla crud_2019.subcontratados: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crud_2019.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '856fc81623da2150ba2210ba1b51d241',
  `type` set('admin','user') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla crud_2019.usuarios: ~1 rows (aproximadamente)
INSERT IGNORE INTO `usuarios` (`id`, `usuario`, `password`, `type`) VALUES
	(9, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
