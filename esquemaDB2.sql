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
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `idUsuario` smallint unsigned DEFAULT NULL,
  `timeStamp` date DEFAULT NULL,
  `tablaCambio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCambio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `idContrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombreContrato` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `idContratante` smallint unsigned DEFAULT '0',
  `idContratado` smallint unsigned DEFAULT '0',
  `subContrato` set('SubContrato','Contrato Origen','Cotizacion') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Contrato Origen',
  `idContratoFuente` smallint DEFAULT NULL,
  `numeroContrato` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inicioContrato` date DEFAULT NULL,
  `finContrato` date DEFAULT NULL,
  `idConvenio` smallint unsigned DEFAULT '0',
  `ubicacionContrato` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `montoContrato` double DEFAULT NULL,
  `anticipoContrato` double DEFAULT NULL,
  `direccion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idContrato`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=767 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.contrato-orden
CREATE TABLE IF NOT EXISTS `contrato-orden` (
  `idRelacionContratoFianza` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idOrden` smallint unsigned DEFAULT NULL,
  `idFianza` smallint DEFAULT NULL,
  PRIMARY KEY (`idRelacionContratoFianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.contrato_convenio
CREATE TABLE IF NOT EXISTS `contrato_convenio` (
  `convenio-contrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idContrato` smallint unsigned NOT NULL DEFAULT '0',
  `idConvenio` smallint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`convenio-contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.contrato_fianza
CREATE TABLE IF NOT EXISTS `contrato_fianza` (
  `idRelacionContratoFianza` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idFianza` smallint unsigned DEFAULT NULL,
  `idContrato` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idRelacionContratoFianza`)
) ENGINE=InnoDB AUTO_INCREMENT=766 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.convenio
CREATE TABLE IF NOT EXISTS `convenio` (
  `idConvenio` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fechaInicio` date DEFAULT NULL,
  `fechaFinal` date DEFAULT NULL,
  `montoAdicional` double DEFAULT '0',
  `documento` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idConvenio`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.datosmedicos
CREATE TABLE IF NOT EXISTS `datosmedicos` (
  `IdDatosMedicos` int unsigned NOT NULL AUTO_INCREMENT,
  `idEmpleado` int unsigned NOT NULL DEFAULT '0',
  `Alergias` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'N/A',
  `EnfermedadesCronicas` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'N/A',
  `Lesiones` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'N/A',
  `AlergiasMedicamentos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'N/A',
  `NumeroSeguro` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `NumeroEmergencia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `TipoSangre` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `NombreEmergencia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Genero` set('masculino','femenino','otro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `RelacionEmergencia` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdDatosMedicos`),
  UNIQUE KEY `idEmpleado` (`idEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.documentacion
CREATE TABLE IF NOT EXISTS `documentacion` (
  `IdDocumentacion` int NOT NULL AUTO_INCREMENT,
  `IdEmpleado` int NOT NULL DEFAULT '0',
  `Credencial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Licencia` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Pasaporte` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CV` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Curp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Inss` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ConstanciaSat` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ActaNacimiento` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin cambio',
  `EstadoCuentaBanco` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin cambio',
  `AltaSeguroSocial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin cambio',
  `CedulaProfecional` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin cambio',
  `CopiaContrato` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin cambio',
  `ComprobanteDomicilio` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin cambio',
  PRIMARY KEY (`IdDocumentacion`),
  UNIQUE KEY `IdEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.documentossubcontratados
CREATE TABLE IF NOT EXISTS `documentossubcontratados` (
  `idDocumentosSubcontratados` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idSubContratado` smallint unsigned DEFAULT NULL,
  `rfc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inss` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ine` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idDocumentosSubcontratados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` smallint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `rfc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `razonSocial` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `representanteLegal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `nombreContacto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correoFacturacion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numeroCuenta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `banco` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipoRegimen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `constanciaFiscal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fechaVencimientoConstancia` date DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.empresa-personal
CREATE TABLE IF NOT EXISTS `empresa-personal` (
  `idRelacion` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` smallint unsigned DEFAULT NULL,
  `idEmpresa` smallint unsigned DEFAULT NULL,
  `terceros` set('true','false') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idRelacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idEmpresa` smallint unsigned DEFAULT '0',
  `idContrato` smallint unsigned NOT NULL DEFAULT '0',
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin definir',
  `numero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'sin definir',
  `fecha` date DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `documento` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idFactura`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.familiares
CREATE TABLE IF NOT EXISTS `familiares` (
  `IdFamiliar` int NOT NULL AUTO_INCREMENT,
  `IdEmpleado` int NOT NULL,
  `TipoParentesco` enum('hijo','pareja','madre','padre','abuelo','abuela','otro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Nombre completo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  PRIMARY KEY (`IdFamiliar`),
  UNIQUE KEY `idEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.fianzas
CREATE TABLE IF NOT EXISTS `fianzas` (
  `idFianzas` smallint unsigned NOT NULL AUTO_INCREMENT,
  `documento` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipoDeCambio` set('dolar','peso') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'peso',
  `fianzaCumplimiento` smallint unsigned DEFAULT NULL,
  `fianzaAnticipo` smallint unsigned DEFAULT NULL,
  `fianzaViciosOcultos` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idFianzas`)
) ENGINE=InnoDB AUTO_INCREMENT=766 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.fianza_anticipo
CREATE TABLE IF NOT EXISTS `fianza_anticipo` (
  `idFianzaAnticipo` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaAnticipoDoc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaAnticipoInicio` date DEFAULT NULL,
  `fianzaAnticipoFin` date DEFAULT NULL,
  `fianzaAnticipoPoliza` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaAnticipoAseguradora` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaAnticipoMonto` double DEFAULT NULL,
  PRIMARY KEY (`idFianzaAnticipo`)
) ENGINE=InnoDB AUTO_INCREMENT=767 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.fianza_cumplimiento
CREATE TABLE IF NOT EXISTS `fianza_cumplimiento` (
  `idFianzaCumplimiento` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaCumplimientoDoc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaCumplimientoInicio` date DEFAULT NULL,
  `fianzaCumplimientoFin` date DEFAULT NULL,
  `fianzaCumplimientoPoliza` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaCumplimientoAseguradora` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaCumplimientoMonto` double DEFAULT NULL,
  PRIMARY KEY (`idFianzaCumplimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=767 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.fianza_vicios_ocultos
CREATE TABLE IF NOT EXISTS `fianza_vicios_ocultos` (
  `idFianzaViciosOcultos` smallint unsigned NOT NULL AUTO_INCREMENT,
  `fianzaViciosOcultosDoc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaViciosOcultosInicio` date DEFAULT NULL,
  `fianzaViciosOcultosFin` date DEFAULT NULL,
  `fianzaViciosOcultosPoliza` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaViciosOcultosAseguradora` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fianzaViciosOcultosMonto` double DEFAULT NULL,
  PRIMARY KEY (`idFianzaViciosOcultos`)
) ENGINE=InnoDB AUTO_INCREMENT=767 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.formacademica
CREATE TABLE IF NOT EXISTS `formacademica` (
  `IdDatosAcademicos` int NOT NULL AUTO_INCREMENT,
  `IdEmpleado` int NOT NULL,
  `Cedula` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `Carrera` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ExpLaboral` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Certificaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `GradoEstudios` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IdDatosAcademicos`) USING BTREE,
  UNIQUE KEY `IdEmpleado` (`IdEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.notificaciones
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idNotificacion` smallint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `fecha` date DEFAULT NULL,
  `vinculoRelacionado` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` set('activo','inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tabla` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idTabla` smallint unsigned DEFAULT NULL,
  PRIMARY KEY (`idNotificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.ordenservicio
CREATE TABLE IF NOT EXISTS `ordenservicio` (
  `idOrden` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idContratante` smallint unsigned DEFAULT NULL,
  `idContratado` smallint unsigned DEFAULT NULL,
  `numeroOrden` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inicioOrden` date DEFAULT NULL,
  `finOrden` date DEFAULT NULL,
  `ubicacionOrden` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `montoOrden` double DEFAULT NULL,
  `anticipo` double DEFAULT NULL,
  `idContratoFuente` smallint DEFAULT NULL,
  `convenio` smallint DEFAULT NULL,
  PRIMARY KEY (`idOrden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.personal_contrato
CREATE TABLE IF NOT EXISTS `personal_contrato` (
  `idRelacionContrato` smallint unsigned NOT NULL AUTO_INCREMENT,
  `idPersonal` smallint unsigned DEFAULT NULL,
  `idContrato` smallint unsigned DEFAULT NULL,
  `tipoPersonal` set('Terceros','Oceanus') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Terceros',
  PRIMARY KEY (`idRelacionContrato`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.subcontratados
CREATE TABLE IF NOT EXISTS `subcontratados` (
  `idSubContratado` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inss` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ine` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` set('activo','inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doc` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idSubContratado`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crud_2019.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '856fc81623da2150ba2210ba1b51d241',
  `type` set('admin','user') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
